<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * TransactionController
 *
 * Manages real estate transactions within an agency.
 */
class TransactionController extends Controller
{
    /**
     * Display a listing of transactions.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data - will be replaced with actual database queries
        $transactions = [
            (object)[
                'id' => 1,
                'property_title' => 'Luxury Downtown Condo',
                'type' => 'Sale',
                'status' => 'In Progress',
                'amount' => 850000,
                'commission' => 25500,
                'buyer' => 'Robert Martinez',
                'seller' => 'Jane Doe',
                'realtor' => 'John Smith',
                'closing_date' => now()->addDays(15),
                'created_at' => now()->subDays(30),
            ],
            (object)[
                'id' => 2,
                'property_title' => 'Suburban Villa',
                'type' => 'Sale',
                'status' => 'Completed',
                'amount' => 625000,
                'commission' => 18750,
                'buyer' => 'Jennifer Lee',
                'seller' => 'Michael Brown',
                'realtor' => 'Emily Davis',
                'closing_date' => now()->subDays(5),
                'created_at' => now()->subMonths(2),
            ],
            (object)[
                'id' => 3,
                'property_title' => 'Modern Loft',
                'type' => 'Rental',
                'status' => 'Pending',
                'amount' => 3500,
                'commission' => 3500,
                'buyer' => 'William Chen',
                'seller' => 'Sarah Johnson',
                'realtor' => 'David Wilson',
                'closing_date' => now()->addDays(7),
                'created_at' => now()->subDays(10),
            ],
        ];

        return view('agency.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tenantId = auth()->user()->tenant_id;

        $properties = [
            (object)['id' => 1, 'title' => 'Luxury Downtown Condo', 'price' => 850000],
            (object)['id' => 2, 'title' => 'Family Home in Suburbs', 'price' => 625000],
        ];

        $clients = [
            (object)['id' => 1, 'name' => 'Robert Martinez'],
            (object)['id' => 2, 'name' => 'Jennifer Lee'],
        ];

        $realtors = [
            (object)['id' => 1, 'name' => 'John Smith'],
            (object)['id' => 2, 'name' => 'Emily Davis'],
        ];

        return view('agency.transactions.create', compact('properties', 'clients', 'realtors'));
    }

    /**
     * Store a newly created transaction in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'type' => ['required', 'in:Sale,Rental,Lease'],
            'status' => ['required', 'in:Pending,In Progress,Completed,Cancelled'],
            'amount' => ['required', 'numeric', 'min:0'],
            'commission' => ['required', 'numeric', 'min:0'],
            'buyer_id' => ['required', 'exists:users,id'],
            'seller_id' => ['nullable', 'exists:users,id'],
            'realtor_id' => ['required', 'exists:users,id'],
            'closing_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $validated['tenant_id'] = auth()->user()->tenant_id;

        // TODO: Create transaction in database
        // Transaction::create($validated);

        return redirect()->route('agency.transactions.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified transaction.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $transaction = (object)[
            'id' => $id,
            'property_title' => 'Luxury Downtown Condo',
            'property_address' => '123 Main St, New York, NY',
            'type' => 'Sale',
            'status' => 'In Progress',
            'amount' => 850000,
            'commission' => 25500,
            'buyer' => 'Robert Martinez',
            'buyer_email' => 'robert@example.com',
            'seller' => 'Jane Doe',
            'seller_email' => 'jane@example.com',
            'realtor' => 'John Smith',
            'closing_date' => now()->addDays(15),
            'notes' => 'Buyer has secured financing. Inspection scheduled for next week.',
            'created_at' => now()->subDays(30),
        ];

        $timeline = [
            (object)['event' => 'Transaction Created', 'date' => now()->subDays(30), 'user' => 'John Smith'],
            (object)['event' => 'Offer Accepted', 'date' => now()->subDays(25), 'user' => 'System'],
            (object)['event' => 'Inspection Scheduled', 'date' => now()->subDays(20), 'user' => 'John Smith'],
            (object)['event' => 'Financing Approved', 'date' => now()->subDays(10), 'user' => 'System'],
        ];

        return view('agency.transactions.show', compact('transaction', 'timeline'));
    }

    /**
     * Show the form for editing the specified transaction.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $transaction = (object)[
            'id' => $id,
            'property_id' => 1,
            'type' => 'Sale',
            'status' => 'In Progress',
            'amount' => 850000,
            'commission' => 25500,
            'buyer_id' => 1,
            'seller_id' => 2,
            'realtor_id' => 1,
            'closing_date' => now()->addDays(15)->format('Y-m-d'),
            'notes' => 'Buyer has secured financing.',
        ];

        $properties = [
            (object)['id' => 1, 'title' => 'Luxury Downtown Condo'],
        ];

        $clients = [
            (object)['id' => 1, 'name' => 'Robert Martinez'],
            (object)['id' => 2, 'name' => 'Jane Doe'],
        ];

        $realtors = [
            (object)['id' => 1, 'name' => 'John Smith'],
        ];

        return view('agency.transactions.edit', compact('transaction', 'properties', 'clients', 'realtors'));
    }

    /**
     * Update the specified transaction in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $tenantId = auth()->user()->tenant_id;

        $validated = $request->validate([
            'type' => ['required', 'in:Sale,Rental,Lease'],
            'status' => ['required', 'in:Pending,In Progress,Completed,Cancelled'],
            'amount' => ['required', 'numeric', 'min:0'],
            'commission' => ['required', 'numeric', 'min:0'],
            'closing_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        // TODO: Update transaction in database
        // $transaction = Transaction::where('tenant_id', $tenantId)->findOrFail($id);
        // $transaction->update($validated);

        return redirect()->route('agency.transactions.index')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified transaction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // TODO: Delete transaction
        // $transaction = Transaction::where('tenant_id', $tenantId)->findOrFail($id);
        // $transaction->delete();

        return redirect()->route('agency.transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
