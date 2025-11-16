<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of properties for the tenant
     */
    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id;

        // Get properties for this tenant
        $properties = Property::where('tenant_id', $tenantId)->get();

        // Calculate stats
        $stats = [
            'total' => $properties->count(),
            'available' => $properties->where('status', 'available')->count(),
            'sold' => $properties->where('status', 'sold')->count(),
            'rented' => $properties->where('status', 'rented')->count(),
            'draft' => $properties->where('status', 'draft')->count(),
        ];

        return view('tenant.properties.index', compact('properties', 'stats'));
    }

    /**
     * Show the form for creating a new property
     */
    public function create()
    {
        return view('tenant.properties.create');
    }

    /**
     * Store a newly created property
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:sale,rent,lease,shortlet',
            'category' => 'required|string',
            'location' => 'required|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area' => 'nullable|numeric|min:0',
            'status' => 'required|in:available,sold,rented,pending,draft',
        ]);

        $validated['tenant_id'] = $request->user()->tenant_id;

        Property::create($validated);

        return redirect()->route('tenant.properties.index')
            ->with('success', 'Property created successfully');
    }

    /**
     * Display the specified property
     */
    public function show($id)
    {
        $property = Property::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        return view('tenant.properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified property
     */
    public function edit($id)
    {
        $property = Property::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        return view('tenant.properties.edit', compact('property'));
    }

    /**
     * Update the specified property
     */
    public function update(Request $request, $id)
    {
        $property = Property::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:sale,rent,lease,shortlet',
            'category' => 'required|string',
            'location' => 'required|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area' => 'nullable|numeric|min:0',
            'status' => 'required|in:available,sold,rented,pending,draft',
        ]);

        $property->update($validated);

        return redirect()->route('tenant.properties.index')
            ->with('success', 'Property updated successfully');
    }

    /**
     * Remove the specified property
     */
    public function destroy($id)
    {
        $property = Property::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        $property->delete();

        return redirect()->route('tenant.properties.index')
            ->with('success', 'Property deleted successfully');
    }
}
