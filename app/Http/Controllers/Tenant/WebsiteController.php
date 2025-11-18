<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Show the website builder page
     */
    public function builder(Request $request)
    {
        $tenantId = $request->user()->tenant_id;

        // Get website settings for this tenant
        $websiteSettings = [
            'theme' => 'default',
            'primary_color' => '#4F46E5',
            'logo' => null,
        ];

        return view('tenant.website.builder', compact('websiteSettings'));
    }

    /**
     * Update website settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'theme' => 'required|string',
            'primary_color' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        // Save website settings logic here

        return redirect()->route('tenant.website.builder')
            ->with('success', 'Website settings updated successfully');
    }
}
