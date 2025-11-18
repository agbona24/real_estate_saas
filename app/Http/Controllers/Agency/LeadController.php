<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * LeadController
 *
 * Manages CRM leads for the agency.
 */
class LeadController extends Controller
{
    /**
     * Display a listing of leads.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data - will be replaced with actual database queries
        $leads = [
            (object)[
                'id' => 1,
                'name' => 'Sarah Johnson',
                'email' => 'sarah@example.com',
                'phone' => '555-0123',
                'status' => 'hot',
                'source' => 'Website',
                'interest' => 'Buying',
                'budget' => 800000,
                'assigned_to' => 'John Smith',
                'created_at' => now()->subHours(2),
                'last_contact' => now()->subHours(1),
            ],
            (object)[
                'id' => 2,
                'name' => 'Michael Brown',
                'email' => 'michael@example.com',
                'phone' => '555-0124',
                'status' => 'warm',
                'source' => 'Referral',
                'interest' => 'Selling',
                'budget' => null,
                'assigned_to' => 'Emily Davis',
                'created_at' => now()->subHours(5),
                'last_contact' => now()->subHours(3),
            ],
            (object)[
                'id' => 3,
                'name' => 'Lisa Anderson',
                'email' => 'lisa@example.com',
                'phone' => '555-0125',
                'status' => 'cold',
                'source' => 'Facebook',
                'interest' => 'Buying',
                'budget' => 500000,
                'assigned_to' => null,
                'created_at' => now()->subDays(2),
                'last_contact' => null,
            ],
        ];

        return view('agency.leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new lead.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tenantId = auth()->user()->tenant_id;

        // Get realtors for assignment
        $realtors = [
            (object)['id' => 1, 'name' => 'John Smith'],
            (object)['id' => 2, 'name' => 'Emily Davis'],
            (object)['id' => 3, 'name' => 'David Wilson'],
        ];

        return view('agency.leads.create', compact('realtors'));
    }

    /**
     * Store a newly created lead in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'in:hot,warm,cold'],
            'source' => ['required', 'string', 'max:100'],
            'interest' => ['required', 'in:Buying,Selling,Renting'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        $validated['tenant_id'] = auth()->user()->tenant_id;

        // TODO: Create lead in database
        // Lead::create($validated);

        return redirect()->route('agency.leads.index')->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified lead.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $lead = (object)[
            'id' => $id,
            'name' => 'Sarah Johnson',
            'email' => 'sarah@example.com',
            'phone' => '555-0123',
            'status' => 'hot',
            'source' => 'Website',
            'interest' => 'Buying',
            'budget' => 800000,
            'notes' => 'Looking for a 3-bedroom condo in downtown area',
            'assigned_to' => 'John Smith',
            'created_at' => now()->subHours(2),
            'last_contact' => now()->subHours(1),
        ];

        $activities = [
            (object)['type' => 'email', 'description' => 'Sent property listings', 'created_at' => now()->subHours(1)],
            (object)['type' => 'call', 'description' => 'Initial consultation call', 'created_at' => now()->subHours(2)],
        ];

        return view('agency.leads.show', compact('lead', 'activities'));
    }

    /**
     * Show the form for editing the specified lead.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $lead = (object)[
            'id' => $id,
            'name' => 'Sarah Johnson',
            'email' => 'sarah@example.com',
            'phone' => '555-0123',
            'status' => 'hot',
            'source' => 'Website',
            'interest' => 'Buying',
            'budget' => 800000,
            'notes' => 'Looking for a 3-bedroom condo in downtown area',
            'assigned_to' => 1,
        ];

        $realtors = [
            (object)['id' => 1, 'name' => 'John Smith'],
            (object)['id' => 2, 'name' => 'Emily Davis'],
            (object)['id' => 3, 'name' => 'David Wilson'],
        ];

        return view('agency.leads.edit', compact('lead', 'realtors'));
    }

    /**
     * Update the specified lead in storage.
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
            'status' => ['required', 'in:hot,warm,cold'],
            'source' => ['required', 'string', 'max:100'],
            'interest' => ['required', 'in:Buying,Selling,Renting'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'assigned_to' => ['nullable', 'exists:users,id'],
        ]);

        // TODO: Update lead in database
        // $lead = Lead::where('tenant_id', $tenantId)->findOrFail($id);
        // $lead->update($validated);

        return redirect()->route('agency.leads.index')->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified lead from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // TODO: Delete lead
        // $lead = Lead::where('tenant_id', $tenantId)->findOrFail($id);
        // $lead->delete();

        return redirect()->route('agency.leads.index')->with('success', 'Lead deleted successfully.');
    }
}
