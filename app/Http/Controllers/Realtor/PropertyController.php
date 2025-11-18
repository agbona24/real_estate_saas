<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * PropertyController
 *
 * Manages properties assigned to the realtor.
 */
class PropertyController extends Controller
{
    /**
     * Display a listing of the realtor's properties.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $realtorId = auth()->id();

        // Demo data - will be replaced with actual database queries
        $properties = [
            (object)[
                'id' => 1,
                'title' => 'Luxury Downtown Condo',
                'address' => '123 Main St, New York, NY 10001',
                'type' => 'Condo',
                'status' => 'active',
                'price' => 850000,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 1800,
                'views' => 245,
                'inquiries' => 12,
                'created_at' => now()->subDays(10),
            ],
            (object)[
                'id' => 2,
                'title' => 'Suburban Villa',
                'address' => '456 Oak Ave, Brooklyn, NY 11201',
                'type' => 'House',
                'status' => 'pending',
                'price' => 625000,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 2500,
                'views' => 178,
                'inquiries' => 8,
                'created_at' => now()->subDays(20),
            ],
            (object)[
                'id' => 3,
                'title' => 'Modern Loft',
                'address' => '789 Gallery St, Queens, NY 11375',
                'type' => 'Loft',
                'status' => 'sold',
                'price' => 475000,
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 1500,
                'views' => 312,
                'inquiries' => 15,
                'created_at' => now()->subMonths(2),
            ],
        ];

        return view('realtor.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new property.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('realtor.properties.create');
    }

    /**
     * Store a newly created property in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'in:House,Condo,Apartment,Loft,Townhouse,Land'],
            'status' => ['required', 'in:active,pending,sold,rented'],
            'price' => ['required', 'numeric', 'min:0'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'zip_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'bathrooms' => ['required', 'numeric', 'min:0'],
            'area' => ['required', 'numeric', 'min:0'],
            'year_built' => ['nullable', 'integer', 'min:1800', 'max:' . (date('Y') + 1)],
            'images.*' => ['nullable', 'image', 'max:5120'],
        ]);

        $validated['tenant_id'] = auth()->user()->tenant_id;
        $validated['assigned_realtor'] = auth()->id();

        // Handle image uploads
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('properties', 'public');
            }
            $validated['images'] = json_encode($images);
        }

        // TODO: Create property in database
        // Property::create($validated);

        return redirect()->route('realtor.properties.index')->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified property.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $realtorId = auth()->id();

        // Demo data
        $property = (object)[
            'id' => $id,
            'title' => 'Luxury Downtown Condo',
            'description' => 'Stunning 3-bedroom condo with panoramic city views...',
            'type' => 'Condo',
            'status' => 'active',
            'price' => 850000,
            'address' => '123 Main St',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '10001',
            'country' => 'USA',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'area' => 1800,
            'year_built' => 2020,
            'views' => 245,
            'inquiries' => 12,
            'images' => ['property1.jpg', 'property2.jpg', 'property3.jpg'],
            'created_at' => now()->subDays(10),
        ];

        $inquiries = [
            (object)['name' => 'Sarah Johnson', 'email' => 'sarah@example.com', 'message' => 'Interested in viewing', 'created_at' => now()->subHours(2)],
        ];

        return view('realtor.properties.show', compact('property', 'inquiries'));
    }

    /**
     * Show the form for editing the specified property.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $realtorId = auth()->id();

        // Demo data
        $property = (object)[
            'id' => $id,
            'title' => 'Luxury Downtown Condo',
            'description' => 'Stunning 3-bedroom condo with panoramic city views...',
            'type' => 'Condo',
            'status' => 'active',
            'price' => 850000,
            'address' => '123 Main St',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '10001',
            'country' => 'USA',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'area' => 1800,
            'year_built' => 2020,
        ];

        return view('realtor.properties.edit', compact('property'));
    }

    /**
     * Update the specified property in storage.
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'in:House,Condo,Apartment,Loft,Townhouse,Land'],
            'status' => ['required', 'in:active,pending,sold,rented'],
            'price' => ['required', 'numeric', 'min:0'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'zip_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'bathrooms' => ['required', 'numeric', 'min:0'],
            'area' => ['required', 'numeric', 'min:0'],
            'year_built' => ['nullable', 'integer', 'min:1800', 'max:' . (date('Y') + 1)],
            'images.*' => ['nullable', 'image', 'max:5120'],
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('properties', 'public');
            }
            $validated['images'] = json_encode($images);
        }

        // TODO: Update property in database
        // $property = Property::where('tenant_id', $tenantId)
        //     ->where('assigned_realtor', $realtorId)
        //     ->findOrFail($id);
        // $property->update($validated);

        return redirect()->route('realtor.properties.index')->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified property from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $realtorId = auth()->id();

        // TODO: Delete property
        // $property = Property::where('tenant_id', $tenantId)
        //     ->where('assigned_realtor', $realtorId)
        //     ->findOrFail($id);
        // $property->delete();

        return redirect()->route('realtor.properties.index')->with('success', 'Property deleted successfully.');
    }
}
