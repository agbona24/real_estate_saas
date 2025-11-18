<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of leads for the tenant
     */
    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id;

        // Get leads for this tenant
        $leads = Lead::where('tenant_id', $tenantId)->get();

        // Get realtors for assignment dropdown
        $realtors = User::where('tenant_id', $tenantId)
            ->where('role', 'realtor')
            ->get();

        // Calculate stats
        $stats = [
            'total' => $leads->count(),
            'new' => $leads->where('status', 'new')->count(),
            'contacted' => $leads->where('status', 'contacted')->count(),
            'qualified' => $leads->where('status', 'qualified')->count(),
            'proposal' => $leads->where('status', 'proposal')->count(),
            'won' => $leads->where('status', 'won')->count(),
            'lost' => $leads->where('status', 'lost')->count(),
        ];

        return view('tenant.leads.index', compact('leads', 'realtors', 'stats'));
    }

    /**
     * Show the form for creating a new lead
     */
    public function create()
    {
        $realtors = User::where('tenant_id', auth()->user()->tenant_id)
            ->where('role', 'realtor')
            ->get();

        return view('tenant.leads.create', compact('realtors'));
    }

    /**
     * Store a newly created lead
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'source' => 'nullable|string',
            'status' => 'required|in:new,contacted,qualified,proposal,negotiation,won,lost',
            'priority' => 'required|in:high,medium,low',
            'budget' => 'nullable|numeric|min:0',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $validated['tenant_id'] = $request->user()->tenant_id;

        Lead::create($validated);

        return redirect()->route('tenant.leads.index')
            ->with('success', 'Lead created successfully');
    }

    /**
     * Display the specified lead
     */
    public function show($id)
    {
        $lead = Lead::where('tenant_id', auth()->user()->tenant_id)
            ->with('assignedTo')
            ->findOrFail($id);

        return view('tenant.leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified lead
     */
    public function edit($id)
    {
        $lead = Lead::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        $realtors = User::where('tenant_id', auth()->user()->tenant_id)
            ->where('role', 'realtor')
            ->get();

        return view('tenant.leads.edit', compact('lead', 'realtors'));
    }

    /**
     * Update the specified lead
     */
    public function update(Request $request, $id)
    {
        $lead = Lead::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'source' => 'nullable|string',
            'status' => 'required|in:new,contacted,qualified,proposal,negotiation,won,lost',
            'priority' => 'required|in:high,medium,low',
            'budget' => 'nullable|numeric|min:0',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $lead->update($validated);

        return redirect()->route('tenant.leads.index')
            ->with('success', 'Lead updated successfully');
    }

    /**
     * Remove the specified lead
     */
    public function destroy($id)
    {
        $lead = Lead::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        $lead->delete();

        return redirect()->route('tenant.leads.index')
            ->with('success', 'Lead deleted successfully');
    }
}
