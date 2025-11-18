<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

/**
 * PaymentController
 *
 * Manages payments and subscription billing for the agency.
 */
class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data - will be replaced with actual database queries
        $payments = [
            (object)[
                'id' => 1,
                'invoice_number' => 'INV-2024-001',
                'type' => 'Subscription',
                'amount' => 99.00,
                'status' => 'Paid',
                'payment_method' => 'Credit Card',
                'description' => 'Professional Plan - Monthly',
                'paid_at' => now()->subDays(5),
                'created_at' => now()->subDays(5),
            ],
            (object)[
                'id' => 2,
                'invoice_number' => 'INV-2024-002',
                'type' => 'Subscription',
                'amount' => 99.00,
                'status' => 'Pending',
                'payment_method' => 'Credit Card',
                'description' => 'Professional Plan - Monthly',
                'paid_at' => null,
                'created_at' => now()->subDays(35),
            ],
            (object)[
                'id' => 3,
                'invoice_number' => 'INV-2024-003',
                'type' => 'Add-on',
                'amount' => 29.00,
                'status' => 'Paid',
                'payment_method' => 'Credit Card',
                'description' => 'Additional Storage - 50GB',
                'paid_at' => now()->subDays(10),
                'created_at' => now()->subDays(10),
            ],
        ];

        $subscription = (object)[
            'plan_name' => 'Professional',
            'price' => 99.00,
            'billing_cycle' => 'monthly',
            'status' => 'active',
            'next_billing_date' => now()->addDays(25),
        ];

        return view('agency.payments.index', compact('payments', 'subscription'));
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

        // Demo data
        $payment = (object)[
            'id' => $id,
            'invoice_number' => 'INV-2024-001',
            'type' => 'Subscription',
            'amount' => 99.00,
            'tax' => 0.00,
            'total' => 99.00,
            'status' => 'Paid',
            'payment_method' => 'Credit Card (**** 4242)',
            'description' => 'Professional Plan - Monthly',
            'billing_period_start' => now()->subDays(35),
            'billing_period_end' => now()->subDays(5),
            'paid_at' => now()->subDays(5),
            'created_at' => now()->subDays(5),
        ];

        $agency = (object)[
            'name' => 'Premier Realty Group',
            'address' => '123 Broadway, New York, NY 10001',
            'email' => 'billing@premierrealty.com',
            'phone' => '555-0100',
        ];

        return view('agency.payments.show', compact('payment', 'agency'));
    }

    /**
     * Show the subscription management page.
     *
     * @return \Illuminate\View\View
     */
    public function subscription()
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $currentSubscription = (object)[
            'plan_name' => 'Professional',
            'price' => 99.00,
            'billing_cycle' => 'monthly',
            'status' => 'active',
            'next_billing_date' => now()->addDays(25),
            'started_at' => now()->subMonths(6),
        ];

        $availablePlans = [
            (object)[
                'id' => 1,
                'name' => 'Starter',
                'price' => 49,
                'billing_cycle' => 'monthly',
                'features' => ['5 Users', '50 Properties', 'Basic CRM'],
            ],
            (object)[
                'id' => 2,
                'name' => 'Professional',
                'price' => 99,
                'billing_cycle' => 'monthly',
                'features' => ['15 Users', '200 Properties', 'Advanced CRM', 'Website Builder'],
            ],
            (object)[
                'id' => 3,
                'name' => 'Enterprise',
                'price' => 299,
                'billing_cycle' => 'monthly',
                'features' => ['Unlimited Users', 'Unlimited Properties', 'Full CRM', 'Custom Website'],
            ],
        ];

        return view('agency.payments.subscription', compact('currentSubscription', 'availablePlans'));
    }

    /**
     * Update subscription plan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSubscription(Request $request)
    {
        $validated = $request->validate([
            'plan_id' => ['required', 'integer'],
        ]);

        $tenantId = auth()->user()->tenant_id;

        // TODO: Update subscription via payment gateway (Stripe, etc.)

        return back()->with('success', 'Subscription updated successfully.');
    }

    /**
     * Cancel subscription.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelSubscription()
    {
        $tenantId = auth()->user()->tenant_id;

        // TODO: Cancel subscription

        return back()->with('success', 'Subscription cancelled successfully. You will retain access until the end of your billing period.');
    }

    /**
     * Update payment method.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePaymentMethod(Request $request)
    {
        $validated = $request->validate([
            'payment_method_id' => ['required', 'string'],
        ]);

        $tenantId = auth()->user()->tenant_id;

        // TODO: Update payment method via Stripe

        return back()->with('success', 'Payment method updated successfully.');
    }

    /**
     * Download invoice PDF.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadInvoice($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // TODO: Generate and download invoice PDF

        return back()->with('info', 'Invoice download functionality will be implemented.');
    }
}
