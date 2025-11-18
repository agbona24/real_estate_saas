<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display subscription management page
     */
    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id;

        // Get current subscription details
        $subscription = [
            'plan' => 'Professional',
            'status' => 'active',
            'next_billing_date' => now()->addMonth(),
            'amount' => 99.00,
        ];

        // Available plans
        $plans = [
            [
                'name' => 'Basic',
                'price' => 49.00,
                'features' => ['Up to 50 properties', '2 realtors', 'Basic support'],
            ],
            [
                'name' => 'Professional',
                'price' => 99.00,
                'features' => ['Up to 200 properties', '10 realtors', 'Priority support', 'Custom branding'],
            ],
            [
                'name' => 'Enterprise',
                'price' => 199.00,
                'features' => ['Unlimited properties', 'Unlimited realtors', '24/7 support', 'Custom domain', 'API access'],
            ],
        ];

        return view('tenant.subscription.index', compact('subscription', 'plans'));
    }

    /**
     * Update subscription plan
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'plan' => 'required|in:basic,professional,enterprise',
        ]);

        // Update subscription logic here

        return redirect()->route('tenant.subscription.index')
            ->with('success', 'Subscription plan updated successfully');
    }
}
