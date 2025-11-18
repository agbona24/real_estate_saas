<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Transaction;
use App\Models\Document;
use Illuminate\Http\Request;

/**
 * DashboardController
 *
 * Handles the client dashboard and overview.
 */
class DashboardController extends Controller
{
    /**
     * Display the client dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;
        $clientId = auth()->id();

        // Demo data - will be replaced with actual database queries
        $stats = [
            'my_properties' => 2,
            'active_transactions' => 1,
            'pending_payments' => 0,
            'total_invested' => 1500000,
            'documents' => 8,
        ];

        $my_properties = [
            (object)[
                'id' => 1,
                'title' => 'Downtown Penthouse',
                'address' => '500 Park Ave, New York, NY',
                'purchase_price' => 900000,
                'purchase_date' => now()->subMonths(2),
                'status' => 'Owned',
                'image' => 'property1.jpg',
            ],
            (object)[
                'id' => 2,
                'title' => 'Suburban Villa',
                'address' => '123 Oak Lane, Brooklyn, NY',
                'purchase_price' => 600000,
                'purchase_date' => now()->subMonths(1),
                'status' => 'Owned',
                'image' => 'property2.jpg',
            ],
        ];

        $active_transactions = [
            (object)[
                'id' => 1,
                'property' => 'Modern Loft',
                'type' => 'Purchase',
                'status' => 'In Progress',
                'amount' => 475000,
                'closing_date' => now()->addDays(15),
                'realtor' => 'John Smith',
            ],
        ];

        $recent_documents = [
            (object)['id' => 1, 'name' => 'Purchase Agreement', 'type' => 'Contract', 'created_at' => now()->subDays(5)],
            (object)['id' => 2, 'name' => 'Property Deed', 'type' => 'Legal', 'created_at' => now()->subDays(10)],
        ];

        $upcoming_payments = [];

        return view('client.dashboard', compact('stats', 'my_properties', 'active_transactions', 'recent_documents', 'upcoming_payments'));
    }
}
