<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of clients for the tenant
     */
    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id;

        // Get clients for this tenant
        $clients = Client::where('tenant_id', $tenantId)
            ->with('assignedTo')
            ->get();

        $stats = [
            'total' => $clients->count(),
            'active' => $clients->where('status', 'active')->count(),
            'inactive' => $clients->where('status', 'inactive')->count(),
        ];

        return view('tenant.clients.index', compact('clients', 'stats'));
    }

    /**
     * Show the form for creating a new client
     */
    public function create()
    {
        $realtors = User::where('tenant_id', auth()->user()->tenant_id)
            ->where('role', 'realtor')
            ->get();

        return view('tenant.clients.create', compact('realtors'));
    }

    /**
     * Store a newly created client
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string',
            'status' => 'required|in:active,inactive',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $validated['tenant_id'] = $request->user()->tenant_id;

        Client::create($validated);

        return redirect()->route('tenant.clients.index')
            ->with('success', 'Client created successfully');
    }

    /**
     * Display the specified client
     */
    public function show($id)
    {
        $client = Client::where('tenant_id', auth()->user()->tenant_id)
            ->with('assignedTo')
            ->findOrFail($id);

        return view('tenant.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified client
     */
    public function edit($id)
    {
        $client = Client::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        $realtors = User::where('tenant_id', auth()->user()->tenant_id)
            ->where('role', 'realtor')
            ->get();

        return view('tenant.clients.edit', compact('client', 'realtors'));
    }

    /**
     * Update the specified client
     */
    public function update(Request $request, $id)
    {
        $client = Client::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'phone' => 'required|string',
            'status' => 'required|in:active,inactive',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $client->update($validated);

        return redirect()->route('tenant.clients.index')
            ->with('success', 'Client updated successfully');
    }

    /**
     * Remove the specified client
     */
    public function destroy($id)
    {
        $client = Client::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        $client->delete();

        return redirect()->route('tenant.clients.index')
            ->with('success', 'Client deleted successfully');
    }
}
