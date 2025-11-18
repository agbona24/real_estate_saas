<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * ClientController
 *
 * Manages clients within an agency.
 */
class ClientController extends Controller
{
    /**
     * Display a listing of clients.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data - will be replaced with actual database queries
        $clients = [
            (object)[
                'id' => 1,
                'name' => 'Robert Martinez',
                'email' => 'robert@example.com',
                'phone' => '555-0201',
                'type' => 'Buyer',
                'realtor' => 'John Smith',
                'properties_owned' => 2,
                'total_spent' => 1500000,
                'status' => 'active',
                'created_at' => now()->subMonths(3),
            ],
            (object)[
                'id' => 2,
                'name' => 'Jennifer Lee',
                'email' => 'jennifer@example.com',
                'phone' => '555-0202',
                'type' => 'Seller',
                'realtor' => 'Emily Davis',
                'properties_owned' => 1,
                'total_spent' => 850000,
                'status' => 'active',
                'created_at' => now()->subMonths(1),
            ],
            (object)[
                'id' => 3,
                'name' => 'William Chen',
                'email' => 'william@example.com',
                'phone' => '555-0203',
                'type' => 'Both',
                'realtor' => 'David Wilson',
                'properties_owned' => 3,
                'total_spent' => 2300000,
                'status' => 'active',
                'created_at' => now()->subYear(),
            ],
        ];

        return view('agency.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new client.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tenantId = auth()->user()->tenant_id;

        $realtors = [
            (object)['id' => 1, 'name' => 'John Smith'],
            (object)['id' => 2, 'name' => 'Emily Davis'],
            (object)['id' => 3, 'name' => 'David Wilson'],
        ];

        return view('agency.clients.create', compact('realtors'));
    }

    /**
     * Store a newly created client in storage.
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
            'address' => ['nullable', 'string'],
            'type' => ['required', 'in:Buyer,Seller,Both'],
            'assigned_realtor' => ['nullable', 'exists:users,id'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'client';
        $validated['tenant_id'] = auth()->user()->tenant_id;

        // TODO: Create client in database
        // User::create($validated);

        return redirect()->route('agency.clients.index')->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified client.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $client = (object)[
            'id' => $id,
            'name' => 'Robert Martinez',
            'email' => 'robert@example.com',
            'phone' => '555-0201',
            'address' => '789 Park Ave, New York, NY 10021',
            'type' => 'Buyer',
            'realtor' => 'John Smith',
            'properties_owned' => 2,
            'total_spent' => 1500000,
            'status' => 'active',
            'created_at' => now()->subMonths(3),
        ];

        $properties = [
            (object)['id' => 1, 'title' => 'Downtown Penthouse', 'purchase_price' => 900000, 'purchase_date' => now()->subMonths(2)],
            (object)['id' => 2, 'title' => 'Suburban Villa', 'purchase_price' => 600000, 'purchase_date' => now()->subMonths(1)],
        ];

        $transactions = [
            (object)['id' => 1, 'type' => 'Purchase', 'amount' => 900000, 'status' => 'Completed', 'date' => now()->subMonths(2)],
        ];

        return view('agency.clients.show', compact('client', 'properties', 'transactions'));
    }

    /**
     * Show the form for editing the specified client.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $client = (object)[
            'id' => $id,
            'name' => 'Robert Martinez',
            'email' => 'robert@example.com',
            'phone' => '555-0201',
            'address' => '789 Park Ave, New York, NY 10021',
            'type' => 'Buyer',
            'assigned_realtor' => 1,
            'status' => 'active',
        ];

        $realtors = [
            (object)['id' => 1, 'name' => 'John Smith'],
            (object)['id' => 2, 'name' => 'Emily Davis'],
            (object)['id' => 3, 'name' => 'David Wilson'],
        ];

        return view('agency.clients.edit', compact('client', 'realtors'));
    }

    /**
     * Update the specified client in storage.
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
            'address' => ['nullable', 'string'],
            'type' => ['required', 'in:Buyer,Seller,Both'],
            'assigned_realtor' => ['nullable', 'exists:users,id'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        // TODO: Update client in database
        // $client = User::where('tenant_id', $tenantId)->findOrFail($id);
        // $client->update($validated);

        return redirect()->route('agency.clients.index')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified client from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // TODO: Delete client
        // $client = User::where('tenant_id', $tenantId)->findOrFail($id);
        // $client->delete();

        return redirect()->route('agency.clients.index')->with('success', 'Client deleted successfully.');
    }
}
