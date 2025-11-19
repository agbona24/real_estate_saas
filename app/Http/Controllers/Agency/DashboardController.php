<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the agency dashboard.
     */
    public function index()
    {
        // TODO: Get current tenant/agency from auth
        // For now, we'll use the first agency for demo purposes

        return view('agency.dashboard');
    }
}
