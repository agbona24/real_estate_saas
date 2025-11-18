<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

/**
 * BranchController
 *
 * Manages agency branches/offices.
 */
class BranchController extends Controller
{
    /**
     * Display a listing of branches.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data - will be replaced with actual database queries
        $branches = [
            (object)[
                'id' => 1,
                'name' => 'Manhattan Office',
                'address' => '123 Broadway, New York, NY 10001',
                'phone' => '555-0301',
                'email' => 'manhattan@agency.com',
                'manager' => 'John Smith',
                'realtors_count' => 8,
                'status' => 'active',
                'created_at' => now()->subYear(),
            ],
            (object)[
                'id' => 2,
                'name' => 'Brooklyn Office',
                'address' => '456 Atlantic Ave, Brooklyn, NY 11201',
                'phone' => '555-0302',
                'email' => 'brooklyn@agency.com',
                'manager' => 'Emily Davis',
                'realtors_count' => 5,
                'status' => 'active',
                'created_at' => now()->subMonths(6),
            ],
            (object)[
                'id' => 3,
                'name' => 'Queens Office',
                'address' => '789 Queens Blvd, Queens, NY 11375',
                'phone' => '555-0303',
                'email' => 'queens@agency.com',
                'manager' => 'David Wilson',
                'realtors_count' => 2,
                'status' => 'inactive',
                'created_at' => now()->subMonths(3),
            ],
        ];

        return view('agency.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new branch.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tenantId = auth()->user()->tenant_id;

        $managers = [
            (object)['id' => 1, 'name' => 'John Smith'],
            (object)['id' => 2, 'name' => 'Emily Davis'],
            (object)['id' => 3, 'name' => 'David Wilson'],
        ];

        return view('agency.branches.create', compact('managers'));
    }

    /**
     * Store a newly created branch in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'zip_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email'],
            'manager_id' => ['nullable', 'exists:users,id'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $validated['tenant_id'] = auth()->user()->tenant_id;

        // TODO: Create branch in database
        // Branch::create($validated);

        return redirect()->route('agency.branches.index')->with('success', 'Branch created successfully.');
    }

    /**
     * Display the specified branch.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $branch = (object)[
            'id' => $id,
            'name' => 'Manhattan Office',
            'address' => '123 Broadway',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '10001',
            'country' => 'USA',
            'phone' => '555-0301',
            'email' => 'manhattan@agency.com',
            'manager' => 'John Smith',
            'realtors_count' => 8,
            'properties_count' => 25,
            'status' => 'active',
            'created_at' => now()->subYear(),
        ];

        $realtors = [
            (object)['id' => 1, 'name' => 'John Smith', 'email' => 'john@agency.com'],
            (object)['id' => 2, 'name' => 'Jane Doe', 'email' => 'jane@agency.com'],
        ];

        return view('agency.branches.show', compact('branch', 'realtors'));
    }

    /**
     * Show the form for editing the specified branch.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $branch = (object)[
            'id' => $id,
            'name' => 'Manhattan Office',
            'address' => '123 Broadway',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '10001',
            'country' => 'USA',
            'phone' => '555-0301',
            'email' => 'manhattan@agency.com',
            'manager_id' => 1,
            'status' => 'active',
        ];

        $managers = [
            (object)['id' => 1, 'name' => 'John Smith'],
            (object)['id' => 2, 'name' => 'Emily Davis'],
        ];

        return view('agency.branches.edit', compact('branch', 'managers'));
    }

    /**
     * Update the specified branch in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $tenantId = auth()->user()->tenant_id;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'zip_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email'],
            'manager_id' => ['nullable', 'exists:users,id'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        // TODO: Update branch in database
        // $branch = Branch::where('tenant_id', $tenantId)->findOrFail($id);
        // $branch->update($validated);

        return redirect()->route('agency.branches.index')->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified branch from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // TODO: Delete branch
        // $branch = Branch::where('tenant_id', $tenantId)->findOrFail($id);
        // $branch->delete();

        return redirect()->route('agency.branches.index')->with('success', 'Branch deleted successfully.');
    }
}
