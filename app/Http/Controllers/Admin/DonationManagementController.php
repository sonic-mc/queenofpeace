<?php
// app/Http/Controllers/Admin/DonationManagementController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DonationManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Donation::with('donor');

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('date_from')) {
            $query->where('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('created_at', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $query->whereHas('donor', function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->search}%")
                  ->orWhere('last_name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        $donations = $query->latest()->paginate(50);

        $stats = [
            'total' => Donation::completed()->sum('amount'),
            'pending' => Donation::pending()->count(),
            'this_month' => Donation::completed()
                ->whereMonth('created_at', now()->month)
                ->sum('amount'),
        ];

        return view('admin.donations.index', compact('donations', 'stats'));
    }

    public function show($id)
    {
        $donation = Donation::with('donor', 'verifiedBy')->findOrFail($id);
        return view('admin.donations.show', compact('donation'));
    }

    public function verify(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:completed,failed',
            'admin_notes' => 'nullable|string',
        ]);

        $donation->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'],
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'paid_at' => $validated['status'] === 'completed' ? now() : null,
        ]);

        if ($validated['status'] === 'completed') {
            // Send confirmation email
            Mail::to($donation->donor->email)->send(new \App\Mail\DonationThankYou($donation, $donation->donor));
        }

        return back()->with('success', 'Donation verified successfully');
    }

    public function export(Request $request)
    {
        $query = Donation::with('donor')->completed();

        if ($request->filled('date_from')) {
            $query->where('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('created_at', '<=', $request->date_to);
        }

        $donations = $query->get();

        $filename = 'donations-' . date('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($donations) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Date', 'Transaction Ref', 'Donor Name', 'Email', 'Phone',
                'Amount', 'Currency', 'Type', 'Payment Method', 'Status'
            ]);

            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->created_at->format('Y-m-d H:i:s'),
                    $donation->transaction_reference,
                    $donation->donor->full_name,
                    $donation->donor->email,
                    $donation->donor->phone,
                    $donation->amount,
                    $donation->currency,
                    $donation->donation_type,
                    $donation->payment_method,
                    $donation->status,
                ]);
            }

            fclose($file);
        }, $filename);
    }

    public function donors()
    {
        $donors = Donor::withCount('donations')
            ->orderBy('total_donated', 'desc')
            ->paginate(50);

        return view('admin.donations.donors', compact('donors'));
    }


    /**
 * Get donor details with donations
 */
public function showDonor($id)
{
    $donor = Donor::with(['donations' => function($query) {
        $query->latest()->take(20);
    }])->findOrFail($id);

    return response()->json($donor);
}

/**
 * Export donors
 */
public function exportDonors(Request $request)
{
    $query = Donor::query();

    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('first_name', 'like', "%{$request->search}%")
              ->orWhere('last_name', 'like', "%{$request->search}%")
              ->orWhere('email', 'like', "%{$request->search}%");
        });
    }

    switch ($request->get('sort', 'total_donated')) {
        case 'donation_count':
            $query->orderBy('donation_count', 'desc');
            break;
        case 'recent':
            $query->orderBy('last_donation_at', 'desc');
            break;
        case 'name':
            $query->orderBy('first_name');
            break;
        default:
            $query->orderBy('total_donated', 'desc');
    }

    $donors = $query->get();

    $filename = 'donors-' . date('Y-m-d') . '.csv';

    return response()->streamDownload(function () use ($donors) {
        $file = fopen('php://output', 'w');

        fputcsv($file, [
            'Name', 'Email', 'Phone', 'Total Donated', 'Donation Count', 'Last Donation'
        ]);

        foreach ($donors as $donor) {
            fputcsv($file, [
                $donor->full_name,
                $donor->email,
                $donor->phone,
                $donor->total_donated,
                $donor->donation_count,
                $donor->last_donation_at ? $donor->last_donation_at->format('Y-m-d H:i:s') : '',
            ]);
        }

        fclose($file);
    }, $filename);
}
}