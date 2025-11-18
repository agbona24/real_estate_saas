<?php

namespace App\Http\Controllers\SaaS;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

/**
 * PlanController
 *
 * Manages subscription plans for the SaaS platform.
 */
class PlanController extends Controller
{
    /**
     * Display a listing of subscription plans.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Demo data
        $plans = [
            (object)[
                'id' => 1,
                'name' => 'Starter',
                'price' => 49,
                'billing_cycle' => 'monthly',
                'max_users' => 5,
                'max_properties' => 50,
                'features' => ['Basic CRM', 'Property Listings', 'Email Support'],
                'is_active' => true,
            ],
            (object)[
                'id' => 2,
                'name' => 'Professional',
                'price' => 99,
                'billing_cycle' => 'monthly',
                'max_users' => 15,
                'max_properties' => 200,
                'features' => ['Advanced CRM', 'Property Listings', 'Website Builder', 'Priority Support'],
                'is_active' => true,
            ],
            (object)[
                'id' => 3,
                'name' => 'Enterprise',
                'price' => 299,
                'billing_cycle' => 'monthly',
                'max_users' => -1, // unlimited
                'max_properties' => -1, // unlimited
                'features' => ['Full CRM', 'Unlimited Properties', 'Custom Website', 'White Label', '24/7 Support', 'API Access'],
                'is_active' => true,
            ],
        ];

        return view('saas.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new plan.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('saas.plans.create');
    }

    /**
     * Store a newly created plan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'billing_cycle' => ['required', 'in:monthly,yearly'],
            'max_users' => ['required', 'integer'],
            'max_properties' => ['required', 'integer'],
            'features' => ['nullable', 'array'],
            'is_active' => ['boolean'],
        ]);

        // TODO: Create plan in database
        // Plan::create($validated);

        return redirect()->route('saas.plans.index')->with('success', 'Plan created successfully.');
    }

    /**
     * Display the specified plan.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Demo data
        $plan = (object)[
            'id' => $id,
            'name' => 'Professional',
            'price' => 99,
            'billing_cycle' => 'monthly',
            'max_users' => 15,
            'max_properties' => 200,
            'features' => ['Advanced CRM', 'Property Listings', 'Website Builder', 'Priority Support'],
            'is_active' => true,
            'subscribers_count' => 23,
        ];

        return view('saas.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified plan.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Demo data
        $plan = (object)[
            'id' => $id,
            'name' => 'Professional',
            'price' => 99,
            'billing_cycle' => 'monthly',
            'max_users' => 15,
            'max_properties' => 200,
            'features' => ['Advanced CRM', 'Property Listings', 'Website Builder', 'Priority Support'],
            'is_active' => true,
        ];

        return view('saas.plans.edit', compact('plan'));
    }

    /**
     * Update the specified plan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'billing_cycle' => ['required', 'in:monthly,yearly'],
            'max_users' => ['required', 'integer'],
            'max_properties' => ['required', 'integer'],
            'features' => ['nullable', 'array'],
            'is_active' => ['boolean'],
        ]);

        // TODO: Update plan in database
        // $plan = Plan::findOrFail($id);
        // $plan->update($validated);

        return redirect()->route('saas.plans.index')->with('success', 'Plan updated successfully.');
    }

    /**
     * Remove the specified plan from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // TODO: Delete plan
        // $plan = Plan::findOrFail($id);
        // $plan->delete();

        return redirect()->route('saas.plans.index')->with('success', 'Plan deleted successfully.');
    }
}
