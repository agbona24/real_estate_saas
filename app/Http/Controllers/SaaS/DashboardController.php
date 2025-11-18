<?php

namespace App\Http\Controllers\SaaS;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Property;
use App\Models\Transaction;
use Illuminate\Http\Request;

/**
 * DashboardController
 *
 * Handles the SaaS admin dashboard and overview statistics.
 */
class DashboardController extends Controller
{
    /**
     * Display the SaaS admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Demo data - will be replaced with actual database queries
        $stats = [
            'total_agencies' => 45,
            'active_agencies' => 38,
            'total_users' => 342,
            'total_properties' => 1250,
            'total_transactions' => 89,
            'monthly_revenue' => 15600,
            'active_subscriptions' => 38,
            'trial_subscriptions' => 7,
        ];

        $recent_agencies = [
            (object)[
                'id' => 1,
                'name' => 'Premier Realty Group',
                'domain' => 'premier-realty',
                'subscription_status' => 'active',
                'created_at' => now()->subDays(2),
                'plan' => 'Professional',
            ],
            (object)[
                'id' => 2,
                'name' => 'Sunshine Properties',
                'domain' => 'sunshine-properties',
                'subscription_status' => 'trial',
                'created_at' => now()->subDays(5),
                'plan' => 'Trial',
            ],
        ];

        $revenue_chart = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'data' => [12500, 13200, 14100, 15000, 14800, 15600],
        ];

        return view('saas.dashboard', compact('stats', 'recent_agencies', 'revenue_chart'));
    }
}
