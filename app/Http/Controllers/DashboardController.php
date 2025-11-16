<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the dashboard based on user role
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Route to different dashboards based on role
        return match($user->role) {
            'super_admin' => view('superadmin.dashboard'),
            'agency_admin' => view('agency.dashboard'),
            'realtor' => view('realtor.dashboard'),
            'client' => view('client.dashboard'),
            default => view('agency.dashboard'),
        };
    }
}
