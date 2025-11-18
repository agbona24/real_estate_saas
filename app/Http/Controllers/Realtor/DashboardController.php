<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Lead;
use App\Models\Transaction;
use Illuminate\Http\Request;

/**
 * DashboardController
 *
 * Handles the realtor dashboard and overview statistics.
 */
class DashboardController extends Controller
{
    /**
     * Display the realtor dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;
        $realtorId = auth()->id();

        // Demo data - will be replaced with actual database queries
        $stats = [
            'my_active_listings' => 8,
            'my_leads' => 24,
            'new_leads' => 3,
            'hot_leads' => 5,
            'my_clients' => 12,
            'active_transactions' => 2,
            'completed_this_month' => 1,
            'total_commission_earned' => 127500,
            'pending_commission' => 15000,
            'properties_viewed' => 156,
        ];

        $recent_leads = [
            (object)[
                'id' => 1,
                'name' => 'Sarah Johnson',
                'email' => 'sarah@example.com',
                'phone' => '555-0123',
                'status' => 'hot',
                'interest' => 'Buying',
                'budget' => 800000,
                'created_at' => now()->subHours(2),
            ],
            (object)[
                'id' => 2,
                'name' => 'Michael Brown',
                'email' => 'michael@example.com',
                'phone' => '555-0124',
                'status' => 'warm',
                'interest' => 'Selling',
                'budget' => null,
                'created_at' => now()->subHours(5),
            ],
        ];

        $my_properties = [
            (object)[
                'id' => 1,
                'title' => 'Luxury Downtown Condo',
                'address' => '123 Main St, New York, NY',
                'price' => 850000,
                'status' => 'active',
                'views' => 45,
                'inquiries' => 8,
            ],
            (object)[
                'id' => 2,
                'title' => 'Suburban Villa',
                'address' => '456 Oak Ave, Brooklyn, NY',
                'price' => 625000,
                'status' => 'pending',
                'views' => 32,
                'inquiries' => 5,
            ],
        ];

        $upcoming_tasks = [
            (object)['task' => 'Property showing with Sarah Johnson', 'date' => now()->addHours(3)],
            (object)['task' => 'Follow up with Michael Brown', 'date' => now()->addDay()],
            (object)['task' => 'Closing meeting for Downtown Condo', 'date' => now()->addDays(5)],
        ];

        return view('realtor.dashboard', compact('stats', 'recent_leads', 'my_properties', 'upcoming_tasks'));
    }
}
