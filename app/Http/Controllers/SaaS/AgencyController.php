<?php

namespace App\Http\Controllers\SaaS;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

/**
 * AgencyController
 *
 * Manages agencies (tenants) in the SaaS platform.
 */
class AgencyController extends Controller
{
    /**
     * Display a listing of all agencies.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Demo data - will be replaced with actual database queries
        $agencies = collect([
            (object)[
                'id' => 1,
                'name' => 'Premier Realty Group',
                'domain' => 'premier-realty',
                'subscription_status' => 'active',
                'subscription_plan' => 'Professional',
                'users_count' => 15,
                'properties_count' => 48,
                'created_at' => now()->subMonths(6),
            ],
            (object)[
                'id' => 2,
                'name' => 'Sunshine Properties',
                'domain' => 'sunshine-properties',
                'subscription_status' => 'trial',
                'subscription_plan' => 'Trial',
                'users_count' => 5,
                'properties_count' => 12,
                'created_at' => now()->subDays(10),
            ],
            (object)[
                'id' => 3,
                'name' => 'Metro Real Estate',
                'domain' => 'metro-real-estate',
                'subscription_status' => 'active',
                'subscription_plan' => 'Enterprise',
                'users_count' => 32,
                'properties_count' => 125,
                'created_at' => now()->subYear(),
            ],
        ]);

        return view('saas.agencies.index', compact('agencies'));
    }

    /**
     * Show the form for creating a new agency.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $plans = ['Starter', 'Professional', 'Enterprise'];
        return view('saas.agencies.create', compact('plans'));
    }

    /**
     * Store a newly created agency in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'domain' => ['required', 'string', 'max:255', 'unique:tenants,domain'],
            'subscription_plan' => ['required', 'string'],
            'admin_name' => ['required', 'string', 'max:255'],
            'admin_email' => ['required', 'email', 'unique:users,email'],
            'admin_password' => ['required', 'string', 'min:8'],
        ]);

        DB::beginTransaction();
        try {
            // Create tenant
            $tenant = Tenant::create([
                'name' => $validated['name'],
                'domain' => $validated['domain'],
                'subscription_status' => 'active',
                'subscription_plan' => $validated['subscription_plan'],
            ]);

            // Create admin user
            $user = User::create([
                'name' => $validated['admin_name'],
                'email' => $validated['admin_email'],
                'password' => Hash::make($validated['admin_password']),
                'role' => 'agency_admin',
                'tenant_id' => $tenant->id,
            ]);

            DB::commit();

            return redirect()->route('saas.agencies.index')->with('success', 'Agency created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Failed to create agency.']);
        }
    }

    /**
     * Display the specified agency.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Demo data
        $agency = (object)[
            'id' => $id,
            'name' => 'Premier Realty Group',
            'domain' => 'premier-realty',
            'subscription_status' => 'active',
            'subscription_plan' => 'Professional',
            'users_count' => 15,
            'properties_count' => 48,
            'transactions_count' => 23,
            'created_at' => now()->subMonths(6),
            'trial_ends_at' => null,
        ];

        $users = [
            (object)['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'agency_admin'],
            (object)['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'realtor'],
        ];

        return view('saas.agencies.show', compact('agency', 'users'));
    }

    /**
     * Show the form for editing the specified agency.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Demo data
        $agency = (object)[
            'id' => $id,
            'name' => 'Premier Realty Group',
            'domain' => 'premier-realty',
            'subscription_status' => 'active',
            'subscription_plan' => 'Professional',
        ];

        $plans = ['Starter', 'Professional', 'Enterprise'];

        return view('saas.agencies.edit', compact('agency', 'plans'));
    }

    /**
     * Update the specified agency in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'subscription_status' => ['required', 'in:active,inactive,trial,suspended'],
            'subscription_plan' => ['required', 'string'],
        ]);

        // TODO: Update agency in database
        // $tenant = Tenant::findOrFail($id);
        // $tenant->update($validated);

        return redirect()->route('saas.agencies.index')->with('success', 'Agency updated successfully.');
    }

    /**
     * Remove the specified agency from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // TODO: Delete agency and all related data
        // $tenant = Tenant::findOrFail($id);
        // $tenant->delete();

        return redirect()->route('saas.agencies.index')->with('success', 'Agency deleted successfully.');
    }
}
