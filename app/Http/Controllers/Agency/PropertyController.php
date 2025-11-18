<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * PropertyController
 *
 * Manages properties within an agency.
 */
class PropertyController extends Controller
{
    /**
     * Display a listing of properties.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

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
                'realtor' => 'John Smith',
                'views' => 245,
                'created_at' => now()->subDays(10),
            ],
            (object)[
                'id' => 2,
                'title' => 'Family Home in Suburbs',
                'address' => '456 Oak Ave, Brooklyn, NY 11201',
                'type' => 'House',
                'status' => 'pending',
                'price' => 625000,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 2500,
                'realtor' => 'Emily Davis',
                'views' => 178,
                'created_at' => now()->subDays(20),
            ],
            (object)[
                'id' => 3,
                'title' => 'Modern Loft in Arts District',
                'address' => '789 Gallery St, Queens, NY 11375',
                'type' => 'Loft',
                'status' => 'sold',
                'price' => 475000,
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 1500,
                'realtor' => 'David Wilson',
                'views' => 312,
                'created_at' => now()->subMonths(2),
            ],
        ];

        return view('agency.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new property.
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

        return view('agency.properties.create', compact('realtors'));
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
            'assigned_realtor' => ['nullable', 'exists:users,id'],
            'images.*' => ['nullable', 'image', 'max:5120'],
        ]);

        $validated['tenant_id'] = auth()->user()->tenant_id;

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

        return redirect()->route('agency.properties.index')->with('success', 'Property created successfully.');
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
            'realtor' => 'John Smith',
            'views' => 245,
            'images' => ['property1.jpg', 'property2.jpg', 'property3.jpg'],
            'created_at' => now()->subDays(10),
        ];

        $similar_properties = [
            (object)['id' => 2, 'title' => 'Modern Loft', 'price' => 780000, 'image' => 'property4.jpg'],
        ];

        return view('agency.properties.show', compact('property', 'similar_properties'));
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
            'assigned_realtor' => 1,
        ];

        $realtors = [
            (object)['id' => 1, 'name' => 'John Smith'],
            (object)['id' => 2, 'name' => 'Emily Davis'],
            (object)['id' => 3, 'name' => 'David Wilson'],
        ];

        return view('agency.properties.edit', compact('property', 'realtors'));
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
            'assigned_realtor' => ['nullable', 'exists:users,id'],
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
        // $property = Property::where('tenant_id', $tenantId)->findOrFail($id);
        // $property->update($validated);

        return redirect()->route('agency.properties.index')->with('success', 'Property updated successfully.');
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

        // TODO: Delete property
        // $property = Property::where('tenant_id', $tenantId)->findOrFail($id);
        // $property->delete();

        return redirect()->route('agency.properties.index')->with('success', 'Property deleted successfully.');
    }
}
