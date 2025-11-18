<?php

namespace App\Http\Controllers\SaaS;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

/**
 * SettingsController
 *
 * Manages global SaaS platform settings.
 */
class SettingsController extends Controller
{
    /**
     * Display the settings page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Demo data
        $settings = [
            'app_name' => 'Real Estate SaaS',
            'app_email' => 'admin@realestate-saas.com',
            'app_phone' => '+1 (555) 123-4567',
            'currency' => 'USD',
            'timezone' => 'America/New_York',
            'date_format' => 'Y-m-d',
            'trial_days' => 14,
            'allow_registration' => true,
            'maintenance_mode' => false,
            'stripe_enabled' => true,
            'stripe_publishable_key' => 'pk_test_***',
            'stripe_secret_key' => 'sk_test_***',
            'smtp_host' => 'smtp.mailtrap.io',
            'smtp_port' => 2525,
            'smtp_username' => 'username',
            'smtp_password' => '***',
            'smtp_encryption' => 'tls',
        ];

        return view('saas.settings.index', compact('settings'));
    }

    /**
     * Update general settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'app_name' => ['required', 'string', 'max:255'],
            'app_email' => ['required', 'email'],
            'app_phone' => ['nullable', 'string', 'max:20'],
            'currency' => ['required', 'string', 'max:3'],
            'timezone' => ['required', 'string'],
            'date_format' => ['required', 'string'],
            'trial_days' => ['required', 'integer', 'min:0', 'max:90'],
            'allow_registration' => ['boolean'],
            'maintenance_mode' => ['boolean'],
        ]);

        // TODO: Update settings in database
        // foreach ($validated as $key => $value) {
        //     Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        // }

        return back()->with('success', 'General settings updated successfully.');
    }

    /**
     * Update payment settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePayment(Request $request)
    {
        $validated = $request->validate([
            'stripe_enabled' => ['boolean'],
            'stripe_publishable_key' => ['required_if:stripe_enabled,true', 'string'],
            'stripe_secret_key' => ['required_if:stripe_enabled,true', 'string'],
        ]);

        // TODO: Update payment settings in database

        return back()->with('success', 'Payment settings updated successfully.');
    }

    /**
     * Update email settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEmail(Request $request)
    {
        $validated = $request->validate([
            'smtp_host' => ['required', 'string'],
            'smtp_port' => ['required', 'integer'],
            'smtp_username' => ['required', 'string'],
            'smtp_password' => ['nullable', 'string'],
            'smtp_encryption' => ['required', 'in:tls,ssl'],
        ]);

        // TODO: Update email settings in database

        return back()->with('success', 'Email settings updated successfully.');
    }

    /**
     * Test email configuration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function testEmail(Request $request)
    {
        $request->validate([
            'test_email' => ['required', 'email'],
        ]);

        // TODO: Send test email

        return back()->with('success', 'Test email sent successfully.');
    }
}
