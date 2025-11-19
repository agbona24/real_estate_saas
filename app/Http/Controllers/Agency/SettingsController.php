<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display agency profile settings
     */
    public function profile()
    {
        return view('agency.settings.profile');
    }

    /**
     * Display branding settings
     */
    public function branding()
    {
        return view('agency.settings.branding');
    }

    /**
     * Display subscription settings
     */
    public function subscription()
    {
        return view('agency.settings.subscription');
    }

    /**
     * Display user management
     */
    public function users()
    {
        return view('agency.settings.users');
    }

    /**
     * Display payment settings
     */
    public function payment()
    {
        return view('agency.settings.payment');
    }

    /**
     * Display security settings
     */
    public function security()
    {
        return view('agency.settings.security');
    }

    /**
     * Display audit logs
     */
    public function auditLogs()
    {
        return view('agency.settings.audit-logs');
    }

    /**
     * Display notification settings
     */
    public function notifications()
    {
        return view('agency.settings.notifications');
    }
}
