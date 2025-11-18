<?php

namespace App\Http\Controllers\SaaS;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * ThemeController
 *
 * Manages themes available for agencies in the SaaS platform.
 */
class ThemeController extends Controller
{
    /**
     * Display a listing of themes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Demo data
        $themes = [
            (object)[
                'id' => 1,
                'name' => 'Modern Estate',
                'slug' => 'modern-estate',
                'description' => 'A sleek, modern theme perfect for luxury real estate',
                'preview_image' => 'themes/modern-estate.jpg',
                'is_active' => true,
                'is_premium' => false,
                'installations_count' => 15,
            ],
            (object)[
                'id' => 2,
                'name' => 'Classic Realty',
                'slug' => 'classic-realty',
                'description' => 'Traditional and professional theme for established agencies',
                'preview_image' => 'themes/classic-realty.jpg',
                'is_active' => true,
                'is_premium' => false,
                'installations_count' => 22,
            ],
            (object)[
                'id' => 3,
                'name' => 'Urban Living',
                'slug' => 'urban-living',
                'description' => 'Contemporary theme for urban property specialists',
                'preview_image' => 'themes/urban-living.jpg',
                'is_active' => true,
                'is_premium' => true,
                'installations_count' => 8,
            ],
        ];

        return view('saas.themes.index', compact('themes'));
    }

    /**
     * Show the form for creating a new theme.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('saas.themes.create');
    }

    /**
     * Store a newly created theme in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:themes,slug'],
            'description' => ['nullable', 'string'],
            'preview_image' => ['nullable', 'image', 'max:2048'],
            'theme_files' => ['nullable', 'file', 'mimes:zip'],
            'is_premium' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        // Handle file uploads
        if ($request->hasFile('preview_image')) {
            $validated['preview_image'] = $request->file('preview_image')->store('themes', 'public');
        }

        if ($request->hasFile('theme_files')) {
            $validated['theme_files'] = $request->file('theme_files')->store('theme-files', 'private');
        }

        // TODO: Create theme in database
        // Theme::create($validated);

        return redirect()->route('saas.themes.index')->with('success', 'Theme created successfully.');
    }

    /**
     * Display the specified theme.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Demo data
        $theme = (object)[
            'id' => $id,
            'name' => 'Modern Estate',
            'slug' => 'modern-estate',
            'description' => 'A sleek, modern theme perfect for luxury real estate',
            'preview_image' => 'themes/modern-estate.jpg',
            'is_active' => true,
            'is_premium' => false,
            'installations_count' => 15,
            'created_at' => now()->subMonths(3),
        ];

        return view('saas.themes.show', compact('theme'));
    }

    /**
     * Show the form for editing the specified theme.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Demo data
        $theme = (object)[
            'id' => $id,
            'name' => 'Modern Estate',
            'slug' => 'modern-estate',
            'description' => 'A sleek, modern theme perfect for luxury real estate',
            'preview_image' => 'themes/modern-estate.jpg',
            'is_active' => true,
            'is_premium' => false,
        ];

        return view('saas.themes.edit', compact('theme'));
    }

    /**
     * Update the specified theme in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'preview_image' => ['nullable', 'image', 'max:2048'],
            'theme_files' => ['nullable', 'file', 'mimes:zip'],
            'is_premium' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        // Handle file uploads
        if ($request->hasFile('preview_image')) {
            $validated['preview_image'] = $request->file('preview_image')->store('themes', 'public');
        }

        if ($request->hasFile('theme_files')) {
            $validated['theme_files'] = $request->file('theme_files')->store('theme-files', 'private');
        }

        // TODO: Update theme in database
        // $theme = Theme::findOrFail($id);
        // $theme->update($validated);

        return redirect()->route('saas.themes.index')->with('success', 'Theme updated successfully.');
    }

    /**
     * Remove the specified theme from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // TODO: Delete theme
        // $theme = Theme::findOrFail($id);
        // $theme->delete();

        return redirect()->route('saas.themes.index')->with('success', 'Theme deleted successfully.');
    }
}
