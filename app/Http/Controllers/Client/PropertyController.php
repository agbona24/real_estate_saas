<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

/**
 * PropertyController
 *
 * Manages client's properties and purchases.
 */
class PropertyController extends Controller
{
    /**
     * Display a listing of client's properties.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;
        $clientId = auth()->id();

        // Demo data - will be replaced with actual database queries
        $properties = [
            (object)[
                'id' => 1,
                'title' => 'Downtown Penthouse',
                'address' => '500 Park Ave, New York, NY 10021',
                'type' => 'Condo',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 2200,
                'purchase_price' => 900000,
                'purchase_date' => now()->subMonths(2),
                'current_value' => 925000,
                'status' => 'Owned',
                'image' => 'property1.jpg',
            ],
            (object)[
                'id' => 2,
                'title' => 'Suburban Villa',
                'address' => '123 Oak Lane, Brooklyn, NY 11201',
                'type' => 'House',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 2800,
                'purchase_price' => 600000,
                'purchase_date' => now()->subMonths(1),
                'current_value' => 615000,
                'status' => 'Owned',
                'image' => 'property2.jpg',
            ],
        ];

        $totalInvested = 1500000;
        $currentValue = 1540000;
        $appreciation = 40000;

        return view('client.properties.index', compact('properties', 'totalInvested', 'currentValue', 'appreciation'));
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
        $clientId = auth()->id();

        // Demo data
        $property = (object)[
            'id' => $id,
            'title' => 'Downtown Penthouse',
            'description' => 'Luxurious 3-bedroom penthouse with stunning city views...',
            'address' => '500 Park Ave',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '10021',
            'type' => 'Condo',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'area' => 2200,
            'year_built' => 2018,
            'purchase_price' => 900000,
            'purchase_date' => now()->subMonths(2),
            'current_value' => 925000,
            'status' => 'Owned',
            'realtor' => 'John Smith',
            'images' => ['property1.jpg', 'property2.jpg', 'property3.jpg'],
        ];

        $documents = [
            (object)['id' => 1, 'name' => 'Purchase Agreement', 'type' => 'Contract', 'created_at' => now()->subMonths(2)],
            (object)['id' => 2, 'name' => 'Property Deed', 'type' => 'Legal', 'created_at' => now()->subMonths(2)],
            (object)['id' => 3, 'name' => 'Home Inspection Report', 'type' => 'Report', 'created_at' => now()->subMonths(2)],
        ];

        $payments = [
            (object)['id' => 1, 'description' => 'Down Payment', 'amount' => 180000, 'status' => 'Paid', 'paid_at' => now()->subMonths(2)],
            (object)['id' => 2, 'description' => 'Closing Costs', 'amount' => 15000, 'status' => 'Paid', 'paid_at' => now()->subMonths(2)],
        ];

        return view('client.properties.show', compact('property', 'documents', 'payments'));
    }

    /**
     * Display available properties for purchase.
     *
     * @return \Illuminate\View\View
     */
    public function browse()
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $properties = [
            (object)[
                'id' => 10,
                'title' => 'Modern Loft in Arts District',
                'address' => '789 Gallery St, Queens, NY',
                'type' => 'Loft',
                'price' => 475000,
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 1500,
                'status' => 'active',
                'image' => 'property10.jpg',
                'realtor' => 'Emily Davis',
            ],
            (object)[
                'id' => 11,
                'title' => 'Luxury Waterfront Condo',
                'address' => '456 Harbor Dr, Manhattan, NY',
                'type' => 'Condo',
                'price' => 1200000,
                'bedrooms' => 3,
                'bathrooms' => 3,
                'area' => 2400,
                'status' => 'active',
                'image' => 'property11.jpg',
                'realtor' => 'David Wilson',
            ],
        ];

        return view('client.properties.browse', compact('properties'));
    }

    /**
     * Express interest in a property.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function expressInterest(Request $request, $id)
    {
        $validated = $request->validate([
            'message' => ['nullable', 'string'],
            'preferred_contact_method' => ['required', 'in:email,phone,both'],
        ]);

        $validated['client_id'] = auth()->id();
        $validated['property_id'] = $id;

        // TODO: Create property inquiry/interest in database

        return back()->with('success', 'Your interest has been submitted. A realtor will contact you soon.');
    }
}
