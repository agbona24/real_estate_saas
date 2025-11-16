<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Property;
use App\Models\User;
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
            'super_admin' => $this->superAdminDashboard($user),
            'agency_admin' => $this->agencyDashboard($user),
            'realtor' => $this->realtorDashboard($user),
            'client' => $this->clientDashboard($user),
            default => $this->agencyDashboard($user),
        };
    }

    /**
     * Super Admin Dashboard
     */
    private function superAdminDashboard($user)
    {
        $stats = [
            'total_agencies' => Agency::count(),
            'new_agencies_this_month' => Agency::whereMonth('created_at', now()->month)->count(),
            'total_users' => User::count(),
            'total_properties' => Property::count(),
        ];

        return view('superadmin.dashboard', compact('stats'));
    }

    /**
     * Agency Admin Dashboard
     */
    private function agencyDashboard($user)
    {
        $tenantId = $user->tenant_id;

        $stats = [
            'total_properties' => Property::where('tenant_id', $tenantId)->count(),
            'new_properties_this_month' => Property::where('tenant_id', $tenantId)
                ->whereMonth('created_at', now()->month)
                ->count(),
            'active_agents' => User::where('tenant_id', $tenantId)
                ->where('role', 'realtor')
                ->count(),
            'active_deals' => Property::where('tenant_id', $tenantId)
                ->where('status', 'pending')
                ->count(),
        ];

        return view('agency.dashboard', compact('stats'));
    }

    /**
     * Realtor Dashboard
     */
    private function realtorDashboard($user)
    {
        $stats = [
            'my_leads' => Lead::where('assigned_to', $user->id)->count(),
            'new_leads_this_week' => Lead::where('assigned_to', $user->id)
                ->where('created_at', '>=', now()->subWeek())
                ->count(),
            'active_clients' => Client::where('assigned_to', $user->id)
                ->where('status', 'active')
                ->count(),
        ];

        // Get recent leads for display
        $recentLeads = Lead::where('assigned_to', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('realtor.dashboard', compact('stats', 'recentLeads'));
    }

    /**
     * Client Dashboard
     */
    private function clientDashboard($user)
    {
        // Find client record linked to this user
        $client = Client::where('user_id', $user->id)->first();

        $stats = [
            'my_properties' => $client ? 3 : 0, // Mock for now
            'pending_payments' => 0, // Mock for now
            'my_documents' => 0, // Mock for now
        ];

        return view('client.dashboard', compact('stats'));
    }
}
