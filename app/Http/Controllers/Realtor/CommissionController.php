<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Transaction;
use Illuminate\Http\Request;

/**
 * CommissionController
 *
 * Manages commission tracking for the realtor.
 */
class CommissionController extends Controller
{
    /**
     * Display a listing of the realtor's commissions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;
        $realtorId = auth()->id();

        // Demo data - will be replaced with actual database queries
        $stats = [
            'total_earned' => 127500,
            'paid_commissions' => 102000,
            'pending_commissions' => 25500,
            'this_month' => 36000,
        ];

        $commissions = [
            (object)[
                'id' => 1,
                'property' => 'Luxury Penthouse',
                'transaction_type' => 'Sale',
                'sale_amount' => 1500000,
                'commission_rate' => 3.0,
                'commission_amount' => 45000,
                'status' => 'Paid',
                'paid_at' => now()->subDays(10),
                'closing_date' => now()->subDays(15),
            ],
            (object)[
                'id' => 2,
                'property' => 'Downtown Condo',
                'transaction_type' => 'Sale',
                'sale_amount' => 850000,
                'commission_rate' => 3.0,
                'commission_amount' => 25500,
                'status' => 'Pending',
                'paid_at' => null,
                'closing_date' => now()->subDays(5),
            ],
            (object)[
                'id' => 3,
                'property' => 'Suburban Villa',
                'transaction_type' => 'Sale',
                'sale_amount' => 625000,
                'commission_rate' => 2.5,
                'commission_amount' => 15625,
                'status' => 'Paid',
                'paid_at' => now()->subDays(30),
                'closing_date' => now()->subMonths(2),
            ],
        ];

        $monthlyChart = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'data' => [15000, 22000, 18000, 28000, 24000, 36000],
        ];

        return view('realtor.commissions.index', compact('stats', 'commissions', 'monthlyChart'));
    }

    /**
     * Display the specified commission.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $realtorId = auth()->id();

        // Demo data
        $commission = (object)[
            'id' => $id,
            'property' => 'Luxury Penthouse',
            'property_address' => '500 Park Ave, New York, NY',
            'transaction_type' => 'Sale',
            'sale_amount' => 1500000,
            'commission_rate' => 3.0,
            'commission_amount' => 45000,
            'status' => 'Paid',
            'paid_at' => now()->subDays(10),
            'closing_date' => now()->subDays(15),
            'buyer' => 'Robert Martinez',
            'seller' => 'Jane Doe',
            'payment_method' => 'Bank Transfer',
            'notes' => 'Commission paid in full via bank transfer',
        ];

        return view('realtor.commissions.show', compact('commission'));
    }

    /**
     * Display commission analytics.
     *
     * @return \Illuminate\View\View
     */
    public function analytics()
    {
        $tenantId = auth()->user()->tenant_id;
        $realtorId = auth()->id();

        // Demo data
        $yearlyStats = [
            'total_sales' => 15,
            'total_volume' => 12750000,
            'total_commission' => 382500,
            'avg_commission' => 25500,
            'highest_commission' => 45000,
        ];

        $yearlyChart = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'data' => [15000, 22000, 18000, 28000, 24000, 36000, 42000, 38000, 31000, 29000, 35000, 40000],
        ];

        $commissionsByType = [
            'labels' => ['Sale', 'Rental', 'Lease'],
            'data' => [340000, 28500, 14000],
        ];

        return view('realtor.commissions.analytics', compact('yearlyStats', 'yearlyChart', 'commissionsByType'));
    }
}
