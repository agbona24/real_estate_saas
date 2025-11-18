@extends('layouts.dashboard')

@section('page-title', 'Agency Dashboard')

@section('page-content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total Properties</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">156</p>
                <p class="text-sm text-green-600 mt-2">+8 this month</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Active Leads</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">48</p>
                <p class="text-sm text-green-600 mt-2">+12 this week</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Realtors</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">24</p>
                <p class="text-sm text-blue-600 mt-2">18 active</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Monthly Revenue</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">$24.5K</p>
                <p class="text-sm text-green-600 mt-2">+15% increase</p>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Two Column Layout -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Recent Leads -->
    <div class="lg:col-span-2 bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Recent Leads</h3>
            <a href="{{ route('agency.leads.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Property Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Budget</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Assigned To</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Sarah Johnson</p>
                                <p class="text-sm text-gray-500">sarah.j@email.com</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">Apartment</td>
                        <td class="px-6 py-4 text-sm text-gray-900">$250K - $300K</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Hot</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">Mike Smith</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm font-medium text-gray-900">John Davis</p>
                                <p class="text-sm text-gray-500">john.d@email.com</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">House</td>
                        <td class="px-6 py-4 text-sm text-gray-900">$500K - $600K</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Warm</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">Lisa Brown</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Emily Wilson</p>
                                <p class="text-sm text-gray-500">emily.w@email.com</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">Condo</td>
                        <td class="px-6 py-4 text-sm text-gray-900">$180K - $220K</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Cold</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">Unassigned</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
        </div>
        <div class="p-6 space-y-3">
            <a href="{{ route('agency.properties.create') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">Add Property</p>
                    <p class="text-xs text-gray-500">List new property</p>
                </div>
            </a>

            <a href="{{ route('agency.leads.create') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-green-500 hover:bg-green-50 transition">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">Add Lead</p>
                    <p class="text-xs text-gray-500">Create new lead</p>
                </div>
            </a>

            <a href="{{ route('agency.realtors.index') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-purple-500 hover:bg-purple-50 transition">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">Manage Realtors</p>
                    <p class="text-xs text-gray-500">View team members</p>
                </div>
            </a>

            <a href="{{ route('agency.reports.index') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-orange-500 hover:bg-orange-50 transition">
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">View Reports</p>
                    <p class="text-xs text-gray-500">Analytics & insights</p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Recent Properties -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-900">Recent Properties</h3>
        <a href="{{ route('agency.properties.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View All</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
        <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
            <div class="aspect-video bg-gray-200 relative">
                <div class="absolute top-3 right-3">
                    <span class="px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded">For Sale</span>
                </div>
            </div>
            <div class="p-4">
                <h4 class="text-lg font-semibold text-gray-900 mb-1">Modern Apartment</h4>
                <p class="text-sm text-gray-500 mb-2">123 Main St, Downtown</p>
                <p class="text-xl font-bold text-blue-600">$325,000</p>
                <div class="flex items-center gap-3 mt-3 text-xs text-gray-600">
                    <span>3 Bed</span>
                    <span>2 Bath</span>
                    <span>1,200 sqft</span>
                </div>
            </div>
        </div>

        <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
            <div class="aspect-video bg-gray-200 relative">
                <div class="absolute top-3 right-3">
                    <span class="px-2 py-1 bg-blue-600 text-white text-xs font-semibold rounded">For Rent</span>
                </div>
            </div>
            <div class="p-4">
                <h4 class="text-lg font-semibold text-gray-900 mb-1">Luxury Villa</h4>
                <p class="text-sm text-gray-500 mb-2">456 Oak Ave, Suburbs</p>
                <p class="text-xl font-bold text-blue-600">$3,500/mo</p>
                <div class="flex items-center gap-3 mt-3 text-xs text-gray-600">
                    <span>4 Bed</span>
                    <span>3 Bath</span>
                    <span>2,500 sqft</span>
                </div>
            </div>
        </div>

        <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
            <div class="aspect-video bg-gray-200 relative">
                <div class="absolute top-3 right-3">
                    <span class="px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded">For Sale</span>
                </div>
            </div>
            <div class="p-4">
                <h4 class="text-lg font-semibold text-gray-900 mb-1">Cozy Studio</h4>
                <p class="text-sm text-gray-500 mb-2">789 Elm St, City Center</p>
                <p class="text-xl font-bold text-blue-600">$185,000</p>
                <div class="flex items-center gap-3 mt-3 text-xs text-gray-600">
                    <span>1 Bed</span>
                    <span>1 Bath</span>
                    <span>600 sqft</span>
                </div>
            </div>
        </div>

        <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
            <div class="aspect-video bg-gray-200 relative">
                <div class="absolute top-3 right-3">
                    <span class="px-2 py-1 bg-purple-600 text-white text-xs font-semibold rounded">Sold</span>
                </div>
            </div>
            <div class="p-4">
                <h4 class="text-lg font-semibold text-gray-900 mb-1">Family Home</h4>
                <p class="text-sm text-gray-500 mb-2">321 Pine Rd, Northside</p>
                <p class="text-xl font-bold text-gray-400">$425,000</p>
                <div class="flex items-center gap-3 mt-3 text-xs text-gray-600">
                    <span>5 Bed</span>
                    <span>3 Bath</span>
                    <span>3,200 sqft</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
