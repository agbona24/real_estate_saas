<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * RealtorController
 *
 * Manages realtors within an agency.
 */
class RealtorController extends Controller
{
    /**
     * Display a listing of realtors.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data - will be replaced with actual database queries
        $realtors = [
            (object)[
                'id' => 1,
                'name' => 'John Smith',
                'email' => 'john.smith@agency.com',
                'phone' => '555-0101',
                'license_number' => 'RE-12345',
                'commission_rate' => 3.0,
                'active_listings' => 8,
                'total_sales' => 2450000,
                'status' => 'active',
                'created_at' => now()->subMonths(6),
            ],
            (object)[
                'id' => 2,
                'name' => 'Emily Davis',
                'email' => 'emily.davis@agency.com',
                'phone' => '555-0102',
                'license_number' => 'RE-12346',
                'commission_rate' => 3.0,
                'active_listings' => 6,
                'total_sales' => 1875000,
                'status' => 'active',
                'created_at' => now()->subMonths(4),
            ],
            (object)[
                'id' => 3,
                'name' => 'David Wilson',
                'email' => 'david.wilson@agency.com',
                'phone' => '555-0103',
                'license_number' => 'RE-12347',
                'commission_rate' => 2.5,
                'active_listings' => 5,
                'total_sales' => 1250000,
                'status' => 'active',
                'created_at' => now()->subMonths(2),
            ],
        ];

        return view('agency.realtors.index', compact('realtors'));
    }

    /**
     * Show the form for creating a new realtor.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('agency.realtors.create');
    }

    /**
     * Store a newly created realtor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['nullable', 'string', 'max:20'],
            'license_number' => ['nullable', 'string', 'max:50'],
            'commission_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'realtor';
        $validated['tenant_id'] = auth()->user()->tenant_id;

        // TODO: Create realtor in database
        // User::create($validated);

        return redirect()->route('agency.realtors.index')->with('success', 'Realtor created successfully.');
    }

    /**
     * Display the specified realtor.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $realtor = (object)[
            'id' => $id,
            'name' => 'John Smith',
            'email' => 'john.smith@agency.com',
            'phone' => '555-0101',
            'license_number' => 'RE-12345',
            'commission_rate' => 3.0,
            'active_listings' => 8,
            'total_sales' => 2450000,
            'total_commission' => 73500,
            'status' => 'active',
            'bio' => 'Experienced real estate professional with 10+ years in the industry.',
            'created_at' => now()->subMonths(6),
        ];

        $properties = [
            (object)['id' => 1, 'title' => 'Luxury Downtown Condo', 'price' => 850000, 'status' => 'active'],
            (object)['id' => 2, 'title' => 'Suburban Family Home', 'price' => 625000, 'status' => 'pending'],
        ];

        $recent_sales = [
            (object)['id' => 1, 'property' => 'Beachfront Villa', 'sale_price' => 1200000, 'commission' => 36000, 'closed_at' => now()->subDays(15)],
        ];

        return view('agency.realtors.show', compact('realtor', 'properties', 'recent_sales'));
    }

    /**
     * Show the form for editing the specified realtor.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $realtor = (object)[
            'id' => $id,
            'name' => 'John Smith',
            'email' => 'john.smith@agency.com',
            'phone' => '555-0101',
            'license_number' => 'RE-12345',
            'commission_rate' => 3.0,
            'status' => 'active',
        ];

        return view('agency.realtors.edit', compact('realtor'));
    }

    /**
     * Update the specified realtor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $tenantId = auth()->user()->tenant_id;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'license_number' => ['nullable', 'string', 'max:50'],
            'commission_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        // TODO: Update realtor in database
        // $realtor = User::where('tenant_id', $tenantId)->findOrFail($id);
        // $realtor->update($validated);

        return redirect()->route('agency.realtors.index')->with('success', 'Realtor updated successfully.');
    }

    /**
     * Remove the specified realtor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // TODO: Delete or deactivate realtor
        // $realtor = User::where('tenant_id', $tenantId)->findOrFail($id);
        // $realtor->delete();

        return redirect()->route('agency.realtors.index')->with('success', 'Realtor deleted successfully.');
    }
}
