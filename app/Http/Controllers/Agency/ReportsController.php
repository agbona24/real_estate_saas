<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display analytics dashboard
     */
    public function index()
    {
        return view('agency.reports.index');
    }

    /**
     * Display sales reports
     */
    public function sales()
    {
        return view('agency.reports.sales');
    }

    /**
     * Display agent performance reports
     */
    public function agentPerformance()
    {
        return view('agency.reports.agent-performance');
    }

    /**
     * Display property performance reports
     */
    public function propertyPerformance()
    {
        return view('agency.reports.property-performance');
    }

    /**
     * Display financial reports
     */
    public function financial()
    {
        return view('agency.reports.financial');
    }
}
