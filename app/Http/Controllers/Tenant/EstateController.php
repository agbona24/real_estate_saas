<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    /**
     * Display a listing of estates for the tenant
     */
    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id;

        $estates = Estate::where('tenant_id', $tenantId)->get();

        $stats = [
            'total' => $estates->count(),
            'active' => $estates->where('status', 'active')->count(),
            'completed' => $estates->where('status', 'completed')->count(),
        ];

        return view('tenant.estates.index', compact('estates', 'stats'));
    }

    /**
     * Show the form for creating a new estate
     */
    public function create()
    {
        return view('tenant.estates.create');
    }

    /**
     * Store a newly created estate
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'total_plots' => 'required|integer|min:1',
            'status' => 'required|in:planning,active,completed',
        ]);

        $validated['tenant_id'] = $request->user()->tenant_id;

        Estate::create($validated);

        return redirect()->route('tenant.estates.index')
            ->with('success', 'Estate created successfully');
    }

    /**
     * Display the specified estate
     */
    public function show($id)
    {
        $estate = Estate::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        return view('tenant.estates.show', compact('estate'));
    }

    /**
     * Show plots for an estate
     */
    public function plots($id)
    {
        $estate = Estate::where('tenant_id', auth()->user()->tenant_id)
            ->with('plots')
            ->findOrFail($id);

        return view('tenant.estates.plots', compact('estate'));
    }

    /**
     * Show allocation page for an estate
     */
    public function allocate($id)
    {
        $estate = Estate::where('tenant_id', auth()->user()->tenant_id)
            ->with('plots')
            ->findOrFail($id);

        return view('tenant.estates.allocate', compact('estate'));
    }

    /**
     * Update the specified estate
     */
    public function update(Request $request, $id)
    {
        $estate = Estate::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'total_plots' => 'required|integer|min:1',
            'status' => 'required|in:planning,active,completed',
        ]);

        $estate->update($validated);

        return redirect()->route('tenant.estates.index')
            ->with('success', 'Estate updated successfully');
    }

    /**
     * Remove the specified estate
     */
    public function destroy($id)
    {
        $estate = Estate::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        $estate->delete();

        return redirect()->route('tenant.estates.index')
            ->with('success', 'Estate deleted successfully');
    }
}
