<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Donor;
use App\Notifications\DonationReceived;
use App\Notifications\DonationThankYou;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    /**
     * Display the donation form
     */
    public function index()
    {
        return view('donate');
    }

    /**
     * Process the donation
     */
    public function process(Request $request)
    {
        // Validate the donation request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'amount' => 'required|numeric|min:5|max:1000000',
            'donation_type' => 'required|in:one-time,monthly',
            'payment_method' => 'required|in:card,mobile_money,bank_transfer,paypal',
            'anonymous' => 'nullable|boolean',
            'message' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            // Create or update donor
            $donor = $this->createOrUpdateDonor($validated);

            // Generate unique transaction reference
            $transactionRef = $this->generateTransactionReference();

            // Create donation record
            $donation = Donation::create([
                'donor_id' => $donor->id,
                'transaction_reference' => $transactionRef,
                'amount' => $validated['amount'],
                'currency' => 'USD', // or get from config
                'donation_type' => $validated['donation_type'],
                'payment_method' => $validated['payment_method'],
                'is_anonymous' => $validated['anonymous'] ?? false,
                'message' => $validated['message'] ?? null,
                'status' => 'pending',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Process payment based on payment method
            $paymentResult = $this->processPayment($donation, $request);

            if ($paymentResult['success']) {
                $donation->update([
                    'status' => 'completed',
                    'payment_id' => $paymentResult['payment_id'] ?? null,
                    'paid_at' => now(),
                ]);

                // Send confirmation emails
                $this->sendDonationConfirmations($donation, $donor);

                // Log successful donation
                Log::info('Donation completed', [
                    'donation_id' => $donation->id,
                    'amount' => $donation->amount,
                    'donor_email' => $donor->email,
                ]);

                DB::commit();

                // Redirect to thank you page
                return redirect()->route('donate.thankyou')
                    ->with('donation', $donation)
                    ->with('success', 'Thank you for your generous donation!');
            } else {
                $donation->update([
                    'status' => 'failed',
                    'failure_reason' => $paymentResult['error'] ?? 'Payment processing failed',
                ]);

                DB::commit();

                return back()->with('error', $paymentResult['error'] ?? 'Payment failed. Please try again.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Donation processing error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'An error occurred while processing your donation. Please try again.');
        }
    }

    /**
     * Create or update donor record
     */
    private function createOrUpdateDonor(array $data)
    {
        return Donor::updateOrCreate(
            ['email' => $data['email']],
            [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'] ?? null,
                'total_donated' => DB::raw('total_donated + ' . $data['amount']),
                'donation_count' => DB::raw('donation_count + 1'),
                'last_donation_at' => now(),
            ]
        );
    }

    /**
     * Generate unique transaction reference
     */
    private function generateTransactionReference(): string
    {
        return 'QP-' . date('Ymd') . '-' . strtoupper(Str::random(8));
    }

    /**
     * Process payment based on payment method
     */
    private function processPayment(Donation $donation, Request $request): array
    {
        switch ($donation->payment_method) {
            case 'card':
                return $this->processCardPayment($donation, $request);
            
            case 'mobile_money':
                return $this->processMobileMoneyPayment($donation, $request);
            
            case 'bank_transfer':
                return $this->processBankTransfer($donation);
            
            case 'paypal':
                return $this->processPayPalPayment($donation, $request);
            
            default:
                return ['success' => false, 'error' => 'Invalid payment method'];
        }
    }

    /**
     * Process credit/debit card payment (Stripe integration)
     */
    private function processCardPayment(Donation $donation, Request $request): array
    {
        try {
            // Initialize Stripe (you'll need to install stripe/stripe-php)
            // composer require stripe/stripe-php
            
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $donation->amount * 100, // Amount in cents
                'currency' => strtolower($donation->currency),
                'description' => 'Donation to Queen of Peace - ' . $donation->transaction_reference,
                'metadata' => [
                    'donation_id' => $donation->id,
                    'transaction_reference' => $donation->transaction_reference,
                ],
                'receipt_email' => $donation->donor->email,
            ]);

            return [
                'success' => true,
                'payment_id' => $paymentIntent->id,
                'client_secret' => $paymentIntent->client_secret,
            ];

        } catch (\Stripe\Exception\CardException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        } catch (\Exception $e) {
            Log::error('Stripe payment error', ['error' => $e->getMessage()]);
            return ['success' => false, 'error' => 'Card payment failed'];
        }
    }

    /**
     * Process mobile money payment (EcoCash, OneMoney)
     */
    private function processMobileMoneyPayment(Donation $donation, Request $request): array
    {
        try {
            // Integrate with local mobile money API
            // Example: Paynow Zimbabwe API
            
            $paynow = new \Paynow\Payments\Paynow(
                config('services.paynow.integration_id'),
                config('services.paynow.integration_key'),
                route('donate.callback'),
                route('donate.return')
            );

            $payment = $paynow->createPayment(
                $donation->transaction_reference,
                $donation->donor->email
            );

            $payment->add('Donation', $donation->amount);

            $response = $paynow->sendMobile(
                $payment,
                $request->input('mobile_number'),
                $request->input('mobile_provider') // ecocash or onemoney
            );

            if ($response->success()) {
                return [
                    'success' => true,
                    'payment_id' => $response->pollUrl(),
                    'instructions' => $response->instructions(),
                ];
            }

            return ['success' => false, 'error' => 'Mobile money payment failed'];

        } catch (\Exception $e) {
            Log::error('Mobile money payment error', ['error' => $e->getMessage()]);
            return ['success' => false, 'error' => 'Mobile money payment failed'];
        }
    }

    /**
     * Process bank transfer
     */
    private function processBankTransfer(Donation $donation): array
    {
        // Bank transfer requires manual verification
        $donation->update([
            'status' => 'pending_verification',
            'payment_instructions' => $this->getBankTransferInstructions($donation),
        ]);

        return [
            'success' => true,
            'payment_id' => 'BANK-' . $donation->transaction_reference,
            'requires_verification' => true,
        ];
    }

    /**
     * Process PayPal payment
     */
    private function processPayPalPayment(Donation $donation, Request $request): array
    {
        try {
            // PayPal SDK integration
            // composer require paypal/rest-api-sdk-php
            
            $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    config('services.paypal.client_id'),
                    config('services.paypal.secret')
                )
            );

            $payer = new \PayPal\Api\Payer();
            $payer->setPaymentMethod('paypal');

            $amount = new \PayPal\Api\Amount();
            $amount->setTotal($donation->amount);
            $amount->setCurrency($donation->currency);

            $transaction = new \PayPal\Api\Transaction();
            $transaction->setAmount($amount);
            $transaction->setDescription('Donation to Queen of Peace');

            $redirectUrls = new \PayPal\Api\RedirectUrls();
            $redirectUrls->setReturnUrl(route('donate.paypal.success'))
                         ->setCancelUrl(route('donate.paypal.cancel'));

            $payment = new \PayPal\Api\Payment();
            $payment->setIntent('sale')
                   ->setPayer($payer)
                   ->setTransactions([$transaction])
                   ->setRedirectUrls($redirectUrls);

            $payment->create($apiContext);

            return [
                'success' => true,
                'payment_id' => $payment->getId(),
                'approval_url' => $payment->getApprovalLink(),
            ];

        } catch (\Exception $e) {
            Log::error('PayPal payment error', ['error' => $e->getMessage()]);
            return ['success' => false, 'error' => 'PayPal payment failed'];
        }
    }

    /**
     * Get bank transfer instructions
     */
    private function getBankTransferInstructions(Donation $donation): string
    {
        return "Please transfer {$donation->amount} {$donation->currency} to:\n\n" .
               "Bank: [Your Bank Name]\n" .
               "Account Name: Queen of Peace Institute\n" .
               "Account Number: [Your Account Number]\n" .
               "Reference: {$donation->transaction_reference}\n\n" .
               "Please email proof of payment to: queenofpeace.org@gmail.com";
    }

    /**
     * Send donation confirmation emails
     */
    private function sendDonationConfirmations(Donation $donation, Donor $donor)
    {
        try {
            // Send thank you email to donor
            Mail::to($donor->email)->send(new \App\Mail\DonationThankYou($donation, $donor));

            // Notify admin
            Mail::to(config('mail.admin_email'))->send(new \App\Mail\DonationReceived($donation, $donor));

        } catch (\Exception $e) {
            Log::error('Email sending failed', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Display thank you page
     */
    public function thankYou()
    {
        $donation = session('donation');
        
        if (!$donation) {
            return redirect()->route('donate.index');
        }

        return view('donate.thankyou', compact('donation'));
    }

    /**
     * Handle payment callbacks
     */
    public function callback(Request $request)
    {
        // Handle payment gateway callbacks
        Log::info('Payment callback received', $request->all());

        $transactionRef = $request->input('reference');
        $status = $request->input('status');

        $donation = Donation::where('transaction_reference', $transactionRef)->first();

        if ($donation && $status === 'success') {
            $donation->update([
                'status' => 'completed',
                'paid_at' => now(),
            ]);

            $this->sendDonationConfirmations($donation, $donation->donor);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Generate donation receipt PDF
     */
    public function receipt($id)
    {
        $donation = Donation::with('donor')->findOrFail($id);

        // You can use a PDF library like dompdf or barryvdh/laravel-dompdf
        $pdf = \PDF::loadView('pdf.donation-receipt', compact('donation'));

        return $pdf->download('receipt-' . $donation->transaction_reference . '.pdf');
    }

    /**
     * Admin: View all donations
     */
    public function adminIndex()
    {
        $donations = Donation::with('donor')
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        $stats = [
            'total_amount' => Donation::where('status', 'completed')->sum('amount'),
            'total_donations' => Donation::where('status', 'completed')->count(),
            'monthly_donors' => Donation::where('donation_type', 'monthly')->distinct('donor_id')->count(),
            'recent_donations' => Donation::where('created_at', '>=', now()->subDays(30))
                ->where('status', 'completed')
                ->sum('amount'),
        ];

        return view('admin.donations.index', compact('donations', 'stats'));
    }

    /**
     * Admin: Verify manual payment
     */
    public function verifyPayment(Request $request, $id)
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
            $this->sendDonationConfirmations($donation, $donation->donor);
        }

        return back()->with('success', 'Donation verified successfully');
    }

    /**
     * Export donations to CSV
     */
    public function export(Request $request)
    {
        $query = Donation::with('donor')->where('status', 'completed');

        if ($request->has('from')) {
            $query->where('created_at', '>=', $request->from);
        }

        if ($request->has('to')) {
            $query->where('created_at', '<=', $request->to);
        }

        $donations = $query->get();

        $filename = 'donations-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($donations) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Date', 'Transaction Ref', 'Donor Name', 'Email', 
                'Amount', 'Currency', 'Type', 'Payment Method', 'Status'
            ]);

            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->created_at->format('Y-m-d H:i:s'),
                    $donation->transaction_reference,
                    $donation->donor->first_name . ' ' . $donation->donor->last_name,
                    $donation->donor->email,
                    $donation->amount,
                    $donation->currency,
                    $donation->donation_type,
                    $donation->payment_method,
                    $donation->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Cancel recurring donation
     */
    public function cancelRecurring($id)
    {
        $donation = Donation::where('id', $id)
            ->where('donation_type', 'monthly')
            ->firstOrFail();

        $donation->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        return back()->with('success', 'Monthly donation cancelled successfully');
    }
}
