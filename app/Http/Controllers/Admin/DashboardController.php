<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\BlogPost;
use App\Models\Gallery;
use App\Models\Donor;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $stats = [
            'total_donations' => Donation::completed()->sum('amount'),
            'donations_count' => Donation::completed()->count(),
            'monthly_donors' => Donation::where('donation_type', 'monthly')
                ->where('status', 'completed')
                ->distinct('donor_id')
                ->count(),
            'total_donors' => Donor::count(),
            'blog_posts' => BlogPost::published()->count(),
            'gallery_items' => Gallery::count(),
            'upcoming_events' => Event::upcoming()->count(),
            'pending_donations' => Donation::pending()->count(),
        ];

        // Recent donations
        $recentDonations = Donation::with('donor')
            ->latest()
            ->take(10)
            ->get();

        // Monthly donation trends (last 12 months)
        $monthlyTrends = Donation::completed()
            ->where('created_at', '>=', now()->subMonths(12))
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(amount) as total'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Top donors
        $topDonors = Donor::orderBy('total_donated', 'desc')
            ->take(5)
            ->get();

        // Recent activity
        $recentActivity = $this->getRecentActivity();

        return view('admin.dashboard', compact(
            'stats',
            'recentDonations',
            'monthlyTrends',
            'topDonors',
            'recentActivity'
        ));
    }

    private function getRecentActivity()
    {
        $activities = collect();

        // Recent donations
        Donation::latest()->take(5)->get()->each(function ($donation) use ($activities) {
            $activities->push([
                'type' => 'donation',
                'icon' => 'fa-heart',
                'color' => 'success',
                'message' => "{$donation->donor->full_name} donated {$donation->formatted_amount}",
                'time' => $donation->created_at,
            ]);
        });

        // Recent blog posts
        BlogPost::latest()->take(3)->get()->each(function ($post) use ($activities) {
            $activities->push([
                'type' => 'blog',
                'icon' => 'fa-newspaper',
                'color' => 'info',
                'message' => "New blog post: {$post->title}",
                'time' => $post->created_at,
            ]);
        });

        return $activities->sortByDesc('time')->take(10);
    }
}
