<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RealtorController extends Controller
{
    /**
     * Display a listing of realtors for the tenant
     */
    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id;

        $realtors = User::where('tenant_id', $tenantId)
            ->where('role', 'realtor')
            ->withCount(['leads', 'clients'])
            ->get();

        $stats = [
            'total' => $realtors->count(),
            'active' => $realtors->where('status', 'active')->count(),
        ];

        return view('tenant.realtors.index', compact('realtors', 'stats'));
    }

    /**
     * Show the form for creating a new realtor
     */
    public function create()
    {
        return view('tenant.realtors.create');
    }

    /**
     * Store a newly created realtor
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['tenant_id'] = $request->user()->tenant_id;
        $validated['role'] = 'realtor';
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('tenant.realtors.index')
            ->with('success', 'Realtor created successfully');
    }

    /**
     * Display the specified realtor
     */
    public function show($id)
    {
        $realtor = User::where('tenant_id', auth()->user()->tenant_id)
            ->where('role', 'realtor')
            ->with(['leads', 'clients'])
            ->findOrFail($id);

        return view('tenant.realtors.show', compact('realtor'));
    }

    /**
     * Update the specified realtor
     */
    public function update(Request $request, $id)
    {
        $realtor = User::where('tenant_id', auth()->user()->tenant_id)
            ->where('role', 'realtor')
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string',
        ]);

        $realtor->update($validated);

        return redirect()->route('tenant.realtors.index')
            ->with('success', 'Realtor updated successfully');
    }

    /**
     * Remove the specified realtor
     */
    public function destroy($id)
    {
        $realtor = User::where('tenant_id', auth()->user()->tenant_id)
            ->where('role', 'realtor')
            ->findOrFail($id);

        $realtor->delete();

        return redirect()->route('tenant.realtors.index')
            ->with('success', 'Realtor deleted successfully');
    }
}
