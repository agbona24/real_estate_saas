<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of menus.
     */
    public function index()
    {
        // TODO: Get current tenant from auth
        $menus = Menu::with('items')->get();

        return view('agency.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new menu.
     */
    public function create()
    {
        return view('agency.menus.create');
    }

    /**
     * Store a newly created menu.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|in:header,footer,sidebar',
            'is_active' => 'boolean',
        ]);

        // TODO: Add tenant_id from auth
        $menu = Menu::create($validated);

        return redirect()
            ->route('agency.menus.index')
            ->with('success', 'Menu created successfully.');
    }

    /**
     * Display the specified menu.
     */
    public function show(Menu $menu)
    {
        $menu->load('topLevelItems.children');

        return view('agency.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified menu.
     */
    public function edit(Menu $menu)
    {
        return view('agency.menus.edit', compact('menu'));
    }

    /**
     * Update the specified menu.
     */
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|in:header,footer,sidebar',
            'is_active' => 'boolean',
        ]);

        $menu->update($validated);

        return redirect()
            ->route('agency.menus.index')
            ->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified menu.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()
            ->route('agency.menus.index')
            ->with('success', 'Menu deleted successfully.');
    }
}
