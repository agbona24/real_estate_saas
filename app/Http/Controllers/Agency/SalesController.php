<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display all transactions
     */
    public function transactions()
    {
        return view('agency.sales.transactions');
    }

    /**
     * Display offers
     */
    public function offers()
    {
        return view('agency.sales.offers');
    }

    /**
     * Display allocations
     */
    public function allocations()
    {
        return view('agency.sales.allocations');
    }

    /**
     * Display reservations
     */
    public function reservations()
    {
        return view('agency.sales.reservations');
    }

    /**
     * Display installment plans
     */
    public function installmentPlans()
    {
        return view('agency.sales.installment-plans');
    }

    /**
     * Display commissions
     */
    public function commissions()
    {
        return view('agency.sales.commissions');
    }

    /**
     * Display closing reports
     */
    public function closingReports()
    {
        return view('agency.sales.closing-reports');
    }
}
