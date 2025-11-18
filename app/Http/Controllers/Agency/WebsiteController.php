<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * WebsiteController
 *
 * Manages agency website builder and customization.
 */
class WebsiteController extends Controller
{
    /**
     * Display the website builder dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $website = (object)[
            'id' => 1,
            'domain' => 'premier-realty.example.com',
            'custom_domain' => 'www.premierrealty.com',
            'theme' => 'Modern Estate',
            'status' => 'published',
            'is_published' => true,
            'last_published' => now()->subDays(3),
        ];

        $pages = [
            (object)['id' => 1, 'title' => 'Home', 'slug' => 'home', 'status' => 'published'],
            (object)['id' => 2, 'title' => 'Properties', 'slug' => 'properties', 'status' => 'published'],
            (object)['id' => 3, 'title' => 'About Us', 'slug' => 'about', 'status' => 'published'],
            (object)['id' => 4, 'title' => 'Contact', 'slug' => 'contact', 'status' => 'published'],
        ];

        return view('agency.website.index', compact('website', 'pages'));
    }

    /**
     * Show the website builder editor.
     *
     * @return \Illuminate\View\View
     */
    public function builder()
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $website = (object)[
            'id' => 1,
            'domain' => 'premier-realty.example.com',
            'theme' => 'Modern Estate',
        ];

        $themes = [
            (object)['id' => 1, 'name' => 'Modern Estate', 'slug' => 'modern-estate'],
            (object)['id' => 2, 'name' => 'Classic Realty', 'slug' => 'classic-realty'],
            (object)['id' => 3, 'name' => 'Urban Living', 'slug' => 'urban-living'],
        ];

        return view('agency.website.builder', compact('website', 'themes'));
    }

    /**
     * Update website settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSettings(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        $validated = $request->validate([
            'custom_domain' => ['nullable', 'string', 'max:255'],
            'theme_id' => ['required', 'integer'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'primary_color' => ['nullable', 'string', 'max:7'],
            'secondary_color' => ['nullable', 'string', 'max:7'],
            'font_family' => ['nullable', 'string', 'max:100'],
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('website/logos', 'public');
        }

        // TODO: Update website settings in database
        // $website = Website::where('tenant_id', $tenantId)->first();
        // $website->update($validated);

        return back()->with('success', 'Website settings updated successfully.');
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\View\View
     */
    public function createPage()
    {
        return view('agency.website.pages.create');
    }

    /**
     * Store a newly created page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePage(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $validated['tenant_id'] = auth()->user()->tenant_id;

        // TODO: Create page in database

        return redirect()->route('agency.website.index')->with('success', 'Page created successfully.');
    }

    /**
     * Show the form for editing a page.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function editPage($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $page = (object)[
            'id' => $id,
            'title' => 'About Us',
            'slug' => 'about',
            'content' => '<h1>About Our Agency</h1><p>We are a premier real estate agency...</p>',
            'meta_title' => 'About Us - Premier Realty',
            'meta_description' => 'Learn more about Premier Realty and our team',
            'status' => 'published',
        ];

        return view('agency.website.pages.edit', compact('page'));
    }

    /**
     * Update the specified page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePage(Request $request, $id)
    {
        $tenantId = auth()->user()->tenant_id;

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
        ]);

        // TODO: Update page in database

        return redirect()->route('agency.website.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Delete a page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyPage($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // TODO: Delete page

        return redirect()->route('agency.website.index')->with('success', 'Page deleted successfully.');
    }

    /**
     * Publish the website.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish()
    {
        $tenantId = auth()->user()->tenant_id;

        // TODO: Publish website changes

        return back()->with('success', 'Website published successfully.');
    }
}
