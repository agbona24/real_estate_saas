<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Lead;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * DashboardController
 *
 * Handles the agency dashboard and overview statistics.
 */
class DashboardController extends Controller
{
    /**
     * Display the agency dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data - will be replaced with actual database queries
        $stats = [
            'total_properties' => 48,
            'active_listings' => 35,
            'total_realtors' => 15,
            'total_leads' => 127,
            'new_leads' => 12,
            'hot_leads' => 8,
            'total_clients' => 45,
            'active_transactions' => 6,
            'completed_transactions' => 23,
            'monthly_revenue' => 125000,
            'pending_commissions' => 15000,
        ];

        $recent_leads = [
            (object)[
                'id' => 1,
                'name' => 'Sarah Johnson',
                'email' => 'sarah@example.com',
                'phone' => '555-0123',
                'status' => 'hot',
                'source' => 'Website',
                'created_at' => now()->subHours(2),
            ],
            (object)[
                'id' => 2,
                'name' => 'Michael Brown',
                'email' => 'michael@example.com',
                'phone' => '555-0124',
                'status' => 'warm',
                'source' => 'Referral',
                'created_at' => now()->subHours(5),
            ],
        ];

        $recent_properties = [
            (object)[
                'id' => 1,
                'title' => 'Luxury Downtown Condo',
                'address' => '123 Main St, New York, NY',
                'price' => 850000,
                'status' => 'active',
                'image' => 'properties/luxury-condo.jpg',
                'views' => 45,
            ],
            (object)[
                'id' => 2,
                'title' => 'Family Home in Suburbs',
                'address' => '456 Oak Ave, Brooklyn, NY',
                'price' => 625000,
                'status' => 'active',
                'image' => 'properties/family-home.jpg',
                'views' => 32,
            ],
        ];

        $top_realtors = [
            (object)[
                'id' => 1,
                'name' => 'John Smith',
                'email' => 'john.smith@agency.com',
                'active_deals' => 4,
                'total_sales' => 2450000,
                'commission_earned' => 73500,
            ],
            (object)[
                'id' => 2,
                'name' => 'Emily Davis',
                'email' => 'emily.davis@agency.com',
                'active_deals' => 3,
                'total_sales' => 1875000,
                'commission_earned' => 56250,
            ],
        ];

        return view('agency.dashboard', compact('stats', 'recent_leads', 'recent_properties', 'top_realtors'));
    }
}
