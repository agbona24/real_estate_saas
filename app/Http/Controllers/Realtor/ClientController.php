<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * ClientController
 *
 * Manages clients assigned to the realtor.
 */
class ClientController extends Controller
{
    /**
     * Display a listing of the realtor's clients.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;
        $realtorId = auth()->id();

        // Demo data - will be replaced with actual database queries
        $clients = [
            (object)[
                'id' => 1,
                'name' => 'Robert Martinez',
                'email' => 'robert@example.com',
                'phone' => '555-0201',
                'type' => 'Buyer',
                'properties_owned' => 2,
                'total_spent' => 1500000,
                'status' => 'active',
                'last_contact' => now()->subDays(2),
            ],
            (object)[
                'id' => 2,
                'name' => 'Jennifer Lee',
                'email' => 'jennifer@example.com',
                'phone' => '555-0202',
                'type' => 'Seller',
                'properties_owned' => 1,
                'total_spent' => 850000,
                'status' => 'active',
                'last_contact' => now()->subDays(5),
            ],
            (object)[
                'id' => 3,
                'name' => 'William Chen',
                'email' => 'william@example.com',
                'phone' => '555-0203',
                'type' => 'Both',
                'properties_owned' => 3,
                'total_spent' => 2300000,
                'status' => 'active',
                'last_contact' => now()->subWeek(),
            ],
        ];

        return view('realtor.clients.index', compact('clients'));
    }

    /**
     * Display the specified client.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $realtorId = auth()->id();

        // Demo data
        $client = (object)[
            'id' => $id,
            'name' => 'Robert Martinez',
            'email' => 'robert@example.com',
            'phone' => '555-0201',
            'address' => '789 Park Ave, New York, NY 10021',
            'type' => 'Buyer',
            'properties_owned' => 2,
            'total_spent' => 1500000,
            'status' => 'active',
            'created_at' => now()->subMonths(3),
            'last_contact' => now()->subDays(2),
        ];

        $properties = [
            (object)[
                'id' => 1,
                'title' => 'Downtown Penthouse',
                'purchase_price' => 900000,
                'purchase_date' => now()->subMonths(2),
                'status' => 'Owned',
            ],
            (object)[
                'id' => 2,
                'title' => 'Suburban Villa',
                'purchase_price' => 600000,
                'purchase_date' => now()->subMonths(1),
                'status' => 'Owned',
            ],
        ];

        $activities = [
            (object)['type' => 'meeting', 'description' => 'Property viewing', 'created_at' => now()->subDays(2)],
            (object)['type' => 'call', 'description' => 'Follow-up call', 'created_at' => now()->subDays(7)],
        ];

        return view('realtor.clients.show', compact('client', 'properties', 'activities'));
    }

    /**
     * Add a note to the client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addNote(Request $request, $id)
    {
        $validated = $request->validate([
            'note' => ['required', 'string'],
        ]);

        $validated['client_id'] = $id;
        $validated['user_id'] = auth()->id();

        // TODO: Create note in database

        return back()->with('success', 'Note added successfully.');
    }
}
