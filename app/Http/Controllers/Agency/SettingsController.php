<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * SettingsController
 *
 * Manages agency-specific settings and configurations.
 */
class SettingsController extends Controller
{
    /**
     * Display the agency settings page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $settings = (object)[
            'agency_name' => 'Premier Realty Group',
            'email' => 'info@premierrealty.com',
            'phone' => '555-0100',
            'address' => '123 Broadway',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '10001',
            'country' => 'USA',
            'logo' => 'agency/logo.png',
            'website' => 'www.premierrealty.com',
            'license_number' => 'RE-AGENCY-12345',
            'timezone' => 'America/New_York',
            'currency' => 'USD',
            'date_format' => 'Y-m-d',
            'language' => 'en',
        ];

        return view('agency.settings.index', compact('settings'));
    }

    /**
     * Update general agency settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateGeneral(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        $validated = $request->validate([
            'agency_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'zip_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'website' => ['nullable', 'url'],
            'license_number' => ['nullable', 'string', 'max:100'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('agency/logos', 'public');
        }

        // TODO: Update tenant settings in database
        // $tenant = Tenant::findOrFail($tenantId);
        // $tenant->update($validated);

        return back()->with('success', 'General settings updated successfully.');
    }

    /**
     * Update localization settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateLocalization(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        $validated = $request->validate([
            'timezone' => ['required', 'string'],
            'currency' => ['required', 'string', 'max:3'],
            'date_format' => ['required', 'string'],
            'language' => ['required', 'string', 'max:5'],
        ]);

        // TODO: Update localization settings

        return back()->with('success', 'Localization settings updated successfully.');
    }

    /**
     * Display notification settings.
     *
     * @return \Illuminate\View\View
     */
    public function notifications()
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $notifications = (object)[
            'new_lead_email' => true,
            'new_lead_sms' => false,
            'property_view_email' => true,
            'transaction_update_email' => true,
            'transaction_update_sms' => true,
            'commission_payment_email' => true,
            'weekly_report_email' => true,
            'monthly_report_email' => true,
        ];

        return view('agency.settings.notifications', compact('notifications'));
    }

    /**
     * Update notification settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateNotifications(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        $validated = $request->validate([
            'new_lead_email' => ['boolean'],
            'new_lead_sms' => ['boolean'],
            'property_view_email' => ['boolean'],
            'transaction_update_email' => ['boolean'],
            'transaction_update_sms' => ['boolean'],
            'commission_payment_email' => ['boolean'],
            'weekly_report_email' => ['boolean'],
            'monthly_report_email' => ['boolean'],
        ]);

        // TODO: Update notification settings

        return back()->with('success', 'Notification settings updated successfully.');
    }

    /**
     * Display integration settings.
     *
     * @return \Illuminate\View\View
     */
    public function integrations()
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $integrations = (object)[
            'google_analytics_id' => 'UA-XXXXXXXXX-X',
            'facebook_pixel_id' => null,
            'mailchimp_api_key' => null,
            'twilio_account_sid' => null,
            'twilio_auth_token' => null,
            'zapier_webhook_url' => null,
        ];

        return view('agency.settings.integrations', compact('integrations'));
    }

    /**
     * Update integration settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateIntegrations(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        $validated = $request->validate([
            'google_analytics_id' => ['nullable', 'string', 'max:255'],
            'facebook_pixel_id' => ['nullable', 'string', 'max:255'],
            'mailchimp_api_key' => ['nullable', 'string', 'max:255'],
            'twilio_account_sid' => ['nullable', 'string', 'max:255'],
            'twilio_auth_token' => ['nullable', 'string', 'max:255'],
            'zapier_webhook_url' => ['nullable', 'url'],
        ]);

        // TODO: Update integration settings

        return back()->with('success', 'Integration settings updated successfully.');
    }

    /**
     * Display team management settings.
     *
     * @return \Illuminate\View\View
     */
    public function team()
    {
        $tenantId = auth()->user()->tenant_id;

        $teamMembers = [
            (object)['id' => 1, 'name' => 'John Smith', 'email' => 'john@agency.com', 'role' => 'agency_admin', 'status' => 'active'],
            (object)['id' => 2, 'name' => 'Emily Davis', 'email' => 'emily@agency.com', 'role' => 'realtor', 'status' => 'active'],
            (object)['id' => 3, 'name' => 'David Wilson', 'email' => 'david@agency.com', 'role' => 'realtor', 'status' => 'active'],
        ];

        return view('agency.settings.team', compact('teamMembers'));
    }

    /**
     * Display security settings.
     *
     * @return \Illuminate\View\View
     */
    public function security()
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $security = (object)[
            'two_factor_enabled' => false,
            'password_expiry_days' => 90,
            'session_timeout_minutes' => 120,
            'ip_whitelist' => [],
        ];

        return view('agency.settings.security', compact('security'));
    }

    /**
     * Update security settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSecurity(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        $validated = $request->validate([
            'two_factor_enabled' => ['boolean'],
            'password_expiry_days' => ['nullable', 'integer', 'min:0', 'max:365'],
            'session_timeout_minutes' => ['nullable', 'integer', 'min:5', 'max:1440'],
        ]);

        // TODO: Update security settings

        return back()->with('success', 'Security settings updated successfully.');
    }
}
