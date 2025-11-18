<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Transaction;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * ReportController
 *
 * Generates various reports and analytics for the agency.
 */
class ReportController extends Controller
{
    /**
     * Display the reports dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;

        $reportTypes = [
            (object)[
                'name' => 'Sales Report',
                'description' => 'Detailed sales and revenue analysis',
                'icon' => 'chart-line',
                'route' => 'agency.reports.sales',
            ],
            (object)[
                'name' => 'Realtor Performance',
                'description' => 'Individual realtor performance metrics',
                'icon' => 'users',
                'route' => 'agency.reports.realtors',
            ],
            (object)[
                'name' => 'Property Analytics',
                'description' => 'Property listings and views analysis',
                'icon' => 'home',
                'route' => 'agency.reports.properties',
            ],
            (object)[
                'name' => 'Lead Conversion',
                'description' => 'Lead funnel and conversion rates',
                'icon' => 'funnel',
                'route' => 'agency.reports.leads',
            ],
            (object)[
                'name' => 'Commission Report',
                'description' => 'Commission calculations and payouts',
                'icon' => 'dollar-sign',
                'route' => 'agency.reports.commissions',
            ],
        ];

        return view('agency.reports.index', compact('reportTypes'));
    }

    /**
     * Display sales report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function sales(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $stats = [
            'total_sales' => 15,
            'total_revenue' => 12750000,
            'total_commission' => 382500,
            'avg_sale_price' => 850000,
            'growth_rate' => 15.5,
        ];

        $monthlySales = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'data' => [2100000, 1850000, 2400000, 2200000, 1950000, 2250000],
        ];

        $topProperties = [
            (object)['title' => 'Luxury Penthouse', 'sale_price' => 1500000, 'realtor' => 'John Smith'],
            (object)['title' => 'Waterfront Villa', 'sale_price' => 1200000, 'realtor' => 'Emily Davis'],
            (object)['title' => 'Downtown Condo', 'sale_price' => 850000, 'realtor' => 'David Wilson'],
        ];

        return view('agency.reports.sales', compact('stats', 'monthlySales', 'topProperties'));
    }

    /**
     * Display realtor performance report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function realtors(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $realtors = [
            (object)[
                'name' => 'John Smith',
                'active_listings' => 8,
                'total_sales' => 5,
                'total_revenue' => 4250000,
                'commission_earned' => 127500,
                'conversion_rate' => 62.5,
                'avg_days_to_close' => 45,
            ],
            (object)[
                'name' => 'Emily Davis',
                'active_listings' => 6,
                'total_sales' => 4,
                'total_revenue' => 3100000,
                'commission_earned' => 93000,
                'conversion_rate' => 66.7,
                'avg_days_to_close' => 38,
            ],
            (object)[
                'name' => 'David Wilson',
                'active_listings' => 5,
                'total_sales' => 3,
                'total_revenue' => 2150000,
                'commission_earned' => 64500,
                'conversion_rate' => 60.0,
                'avg_days_to_close' => 52,
            ],
        ];

        return view('agency.reports.realtors', compact('realtors'));
    }

    /**
     * Display property analytics report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function properties(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $stats = [
            'total_properties' => 48,
            'active_listings' => 35,
            'pending_sales' => 6,
            'sold_properties' => 7,
            'avg_price' => 725000,
            'avg_days_on_market' => 42,
        ];

        $propertyTypeDistribution = [
            'labels' => ['Condo', 'House', 'Apartment', 'Loft', 'Townhouse'],
            'data' => [15, 12, 8, 7, 6],
        ];

        $topViewedProperties = [
            (object)['title' => 'Luxury Downtown Condo', 'views' => 345, 'status' => 'active'],
            (object)['title' => 'Modern Loft', 'views' => 312, 'status' => 'pending'],
            (object)['title' => 'Suburban Villa', 'views' => 289, 'status' => 'active'],
        ];

        return view('agency.reports.properties', compact('stats', 'propertyTypeDistribution', 'topViewedProperties'));
    }

    /**
     * Display lead conversion report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function leads(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $stats = [
            'total_leads' => 127,
            'hot_leads' => 12,
            'warm_leads' => 35,
            'cold_leads' => 80,
            'converted_leads' => 23,
            'conversion_rate' => 18.1,
        ];

        $leadsBySource = [
            'labels' => ['Website', 'Referral', 'Facebook', 'Google Ads', 'Walk-in'],
            'data' => [45, 28, 22, 18, 14],
        ];

        $conversionFunnel = [
            (object)['stage' => 'New Lead', 'count' => 127, 'percentage' => 100],
            (object)['stage' => 'Contacted', 'count' => 89, 'percentage' => 70],
            (object)['stage' => 'Qualified', 'count' => 47, 'percentage' => 37],
            (object)['stage' => 'Showing Scheduled', 'count' => 31, 'percentage' => 24],
            (object)['stage' => 'Converted', 'count' => 23, 'percentage' => 18],
        ];

        return view('agency.reports.leads', compact('stats', 'leadsBySource', 'conversionFunnel'));
    }

    /**
     * Display commission report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function commissions(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $stats = [
            'total_commissions' => 382500,
            'paid_commissions' => 285000,
            'pending_commissions' => 97500,
        ];

        $commissions = [
            (object)[
                'realtor' => 'John Smith',
                'property' => 'Luxury Penthouse',
                'sale_amount' => 1500000,
                'commission_rate' => 3.0,
                'commission_amount' => 45000,
                'status' => 'Paid',
                'paid_at' => now()->subDays(10),
            ],
            (object)[
                'realtor' => 'Emily Davis',
                'property' => 'Waterfront Villa',
                'sale_amount' => 1200000,
                'commission_rate' => 3.0,
                'commission_amount' => 36000,
                'status' => 'Pending',
                'paid_at' => null,
            ],
            (object)[
                'realtor' => 'David Wilson',
                'property' => 'Downtown Condo',
                'sale_amount' => 850000,
                'commission_rate' => 2.5,
                'commission_amount' => 21250,
                'status' => 'Paid',
                'paid_at' => now()->subDays(5),
            ],
        ];

        return view('agency.reports.commissions', compact('stats', 'commissions'));
    }

    /**
     * Export report to PDF.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $type
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request, $type)
    {
        $tenantId = auth()->user()->tenant_id;

        // TODO: Generate PDF report using a library like DomPDF or Snappy

        return back()->with('info', 'Report export functionality will be implemented.');
    }
}
