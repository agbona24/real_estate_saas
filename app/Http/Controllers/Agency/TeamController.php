<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of team members/realtors.
     */
    public function index()
    {
        // TODO: Get team members from database
        return view('agency.team.index');
    }

    /**
     * Show team performance metrics.
     */
    public function performance()
    {
        return view('agency.team.performance');
    }

    /**
     * Show roles and permissions management.
     */
    public function roles()
    {
        return view('agency.team.roles');
    }

    /**
     * Show activity logs.
     */
    public function activityLogs()
    {
        return view('agency.team.activity-logs');
    }
}
