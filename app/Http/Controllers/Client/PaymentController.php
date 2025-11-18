<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

/**
 * PaymentController
 *
 * Manages payments and financial transactions for the client.
 */
class PaymentController extends Controller
{
    /**
     * Display a listing of client's payments.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;
        $clientId = auth()->id();

        // Demo data - will be replaced with actual database queries
        $payments = [
            (object)[
                'id' => 1,
                'invoice_number' => 'INV-2024-001',
                'property' => 'Downtown Penthouse',
                'description' => 'Down Payment',
                'amount' => 180000,
                'status' => 'Paid',
                'payment_method' => 'Bank Transfer',
                'paid_at' => now()->subMonths(2),
                'created_at' => now()->subMonths(2),
            ],
            (object)[
                'id' => 2,
                'invoice_number' => 'INV-2024-002',
                'property' => 'Downtown Penthouse',
                'description' => 'Closing Costs',
                'amount' => 15000,
                'status' => 'Paid',
                'payment_method' => 'Credit Card',
                'paid_at' => now()->subMonths(2),
                'created_at' => now()->subMonths(2),
            ],
            (object)[
                'id' => 3,
                'invoice_number' => 'INV-2024-003',
                'property' => 'Suburban Villa',
                'description' => 'Down Payment',
                'amount' => 120000,
                'status' => 'Paid',
                'payment_method' => 'Bank Transfer',
                'paid_at' => now()->subMonth(),
                'created_at' => now()->subMonth(),
            ],
            (object)[
                'id' => 4,
                'invoice_number' => 'INV-2024-004',
                'property' => 'Suburban Villa',
                'description' => 'Closing Costs',
                'amount' => 12000,
                'status' => 'Paid',
                'payment_method' => 'Credit Card',
                'paid_at' => now()->subMonth(),
                'created_at' => now()->subMonth(),
            ],
        ];

        $stats = [
            'total_paid' => 327000,
            'pending_payments' => 0,
            'payment_count' => 4,
        ];

        return view('client.payments.index', compact('payments', 'stats'));
    }

    /**
     * Display the specified payment invoice.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $clientId = auth()->id();

        // Demo data
        $payment = (object)[
            'id' => $id,
            'invoice_number' => 'INV-2024-001',
            'property' => 'Downtown Penthouse',
            'property_address' => '500 Park Ave, New York, NY',
            'description' => 'Down Payment',
            'amount' => 180000,
            'tax' => 0,
            'total' => 180000,
            'status' => 'Paid',
            'payment_method' => 'Bank Transfer',
            'transaction_id' => 'TXN-2024-12345',
            'paid_at' => now()->subMonths(2),
            'created_at' => now()->subMonths(2),
            'due_date' => now()->subMonths(2)->subDays(7),
        ];

        $client = auth()->user();

        return view('client.payments.show', compact('payment', 'client'));
    }

    /**
     * Make a payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makePayment(Request $request)
    {
        $validated = $request->validate([
            'payment_id' => ['required', 'integer'],
            'payment_method_id' => ['required', 'string'],
        ]);

        $clientId = auth()->id();

        // TODO: Process payment via payment gateway (Stripe, etc.)

        return back()->with('success', 'Payment processed successfully.');
    }

    /**
     * Download payment receipt.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadReceipt($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $clientId = auth()->id();

        // TODO: Generate and download payment receipt PDF

        return back()->with('info', 'Receipt download functionality will be implemented.');
    }

    /**
     * Display payment methods.
     *
     * @return \Illuminate\View\View
     */
    public function paymentMethods()
    {
        $clientId = auth()->id();

        // Demo data
        $paymentMethods = [
            (object)[
                'id' => 1,
                'type' => 'credit_card',
                'last4' => '4242',
                'brand' => 'Visa',
                'exp_month' => 12,
                'exp_year' => 2025,
                'is_default' => true,
            ],
            (object)[
                'id' => 2,
                'type' => 'bank_account',
                'last4' => '6789',
                'bank_name' => 'Chase Bank',
                'is_default' => false,
            ],
        ];

        return view('client.payments.methods', compact('paymentMethods'));
    }

    /**
     * Add a new payment method.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPaymentMethod(Request $request)
    {
        $validated = $request->validate([
            'payment_method_id' => ['required', 'string'],
            'is_default' => ['boolean'],
        ]);

        $clientId = auth()->id();

        // TODO: Add payment method via payment gateway

        return back()->with('success', 'Payment method added successfully.');
    }

    /**
     * Remove a payment method.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removePaymentMethod($id)
    {
        $clientId = auth()->id();

        // TODO: Remove payment method

        return back()->with('success', 'Payment method removed successfully.');
    }
}
