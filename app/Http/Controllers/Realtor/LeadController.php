<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

/**
 * LeadController
 *
 * Manages leads assigned to the realtor.
 */
class LeadController extends Controller
{
    /**
     * Display a listing of the realtor's leads.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $realtorId = auth()->id();

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
                'created_at' => now()->subHours(2),
                'last_contact' => now()->subHours(1),
                'next_followup' => now()->addHours(24),
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
                'created_at' => now()->subHours(5),
                'last_contact' => now()->subHours(3),
                'next_followup' => now()->addDays(2),
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
                'created_at' => now()->subDays(2),
                'last_contact' => null,
                'next_followup' => now()->addDay(),
            ],
        ];

        return view('realtor.leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new lead.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('realtor.leads.create');
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
        ]);

        $validated['tenant_id'] = auth()->user()->tenant_id;
        $validated['assigned_to'] = auth()->id();

        // TODO: Create lead in database
        // Lead::create($validated);

        return redirect()->route('realtor.leads.index')->with('success', 'Lead created successfully.');
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
        $realtorId = auth()->id();

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
            'created_at' => now()->subHours(2),
            'last_contact' => now()->subHours(1),
            'next_followup' => now()->addHours(24),
        ];

        $activities = [
            (object)['type' => 'email', 'description' => 'Sent property listings', 'created_at' => now()->subHours(1)],
            (object)['type' => 'call', 'description' => 'Initial consultation call', 'created_at' => now()->subHours(2)],
            (object)['type' => 'note', 'description' => 'Client prefers modern design', 'created_at' => now()->subHours(3)],
        ];

        $recommended_properties = [
            (object)['id' => 1, 'title' => 'Luxury Downtown Condo', 'price' => 850000],
            (object)['id' => 2, 'title' => 'Modern Loft', 'price' => 780000],
        ];

        return view('realtor.leads.show', compact('lead', 'activities', 'recommended_properties'));
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
        $realtorId = auth()->id();

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
            'next_followup' => now()->addHours(24)->format('Y-m-d H:i'),
        ];

        return view('realtor.leads.edit', compact('lead'));
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
        $realtorId = auth()->id();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'in:hot,warm,cold'],
            'source' => ['required', 'string', 'max:100'],
            'interest' => ['required', 'in:Buying,Selling,Renting'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'next_followup' => ['nullable', 'date'],
        ]);

        // TODO: Update lead in database
        // $lead = Lead::where('tenant_id', $tenantId)
        //     ->where('assigned_to', $realtorId)
        //     ->findOrFail($id);
        // $lead->update($validated);

        return redirect()->route('realtor.leads.index')->with('success', 'Lead updated successfully.');
    }

    /**
     * Add an activity to the lead.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addActivity(Request $request, $id)
    {
        $validated = $request->validate([
            'type' => ['required', 'in:call,email,meeting,note'],
            'description' => ['required', 'string'],
        ]);

        $validated['lead_id'] = $id;
        $validated['user_id'] = auth()->id();

        // TODO: Create activity in database

        return back()->with('success', 'Activity added successfully.');
    }
}
