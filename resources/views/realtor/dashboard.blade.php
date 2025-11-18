@extends('layouts.dashboard')

@section('page-title', 'Realtor Dashboard')

@section('page-content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">My Properties</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">24</p>
                <p class="text-sm text-green-600 mt-2">+3 this month</p>
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
                <p class="text-sm font-medium text-gray-600">My Leads</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">12</p>
                <p class="text-sm text-green-600 mt-2">+5 this week</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">My Clients</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">8</p>
                <p class="text-sm text-blue-600 mt-2">6 active</p>
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
                <p class="text-sm font-medium text-gray-600">This Month</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">$45K</p>
                <p class="text-sm text-green-600 mt-2">$8.5K commission</p>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">My Active Leads</h3>
            <a href="{{ route('realtor.leads.index') }}" class="text-sm text-blue-600 hover:text-blue-700">View All</a>
        </div>
        <div class="p-6 space-y-4">
            <div class="flex items-start justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                <div>
                    <p class="font-medium text-gray-900">Sarah Johnson</p>
                    <p class="text-sm text-gray-600">Apartment • $250K-$300K</p>
                    <p class="text-xs text-gray-500 mt-1">Added 2 days ago</p>
                </div>
                <span class="px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded-full">Hot</span>
            </div>
            <div class="flex items-start justify-between p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div>
                    <p class="font-medium text-gray-900">John Davis</p>
                    <p class="text-sm text-gray-600">House • $500K-$600K</p>
                    <p class="text-xs text-gray-500 mt-1">Added 3 days ago</p>
                </div>
                <span class="px-2 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full">Warm</span>
            </div>
            <div class="flex items-start justify-between p-4 bg-gray-50 border border-gray-200 rounded-lg">
                <div>
                    <p class="font-medium text-gray-900">Emily Wilson</p>
                    <p class="text-sm text-gray-600">Condo • $180K-$220K</p>
                    <p class="text-xs text-gray-500 mt-1">Added 5 days ago</p>
                </div>
                <span class="px-2 py-1 bg-gray-600 text-white text-xs font-semibold rounded-full">Cold</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Recent Commissions</h3>
        </div>
        <div class="p-6">
            <table class="w-full">
                <tbody class="divide-y">
                    <tr>
                        <td class="py-3">
                            <p class="text-sm font-medium text-gray-900">Modern Apartment</p>
                            <p class="text-xs text-gray-500">Nov 15, 2025</p>
                        </td>
                        <td class="py-3 text-right">
                            <p class="text-sm font-medium text-green-600">+$4,875</p>
                            <p class="text-xs text-gray-500">3% of $162,500</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3">
                            <p class="text-sm font-medium text-gray-900">Downtown Condo</p>
                            <p class="text-xs text-gray-500">Nov 10, 2025</p>
                        </td>
                        <td class="py-3 text-right">
                            <p class="text-sm font-medium text-green-600">+$3,600</p>
                            <p class="text-xs text-gray-500">3% of $120,000</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3">
                            <p class="text-sm font-medium text-gray-900">Family Home</p>
                            <p class="text-xs text-gray-500">Nov 5, 2025</p>
                        </td>
                        <td class="py-3 text-right">
                            <p class="text-sm font-medium text-green-600">+$6,375</p>
                            <p class="text-xs text-gray-500">3% of $212,500</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('realtor.commissions.index') }}" class="block mt-4 text-center text-sm text-blue-600 hover:text-blue-800">View All Commissions</a>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-900">My Properties</h3>
        <a href="{{ route('realtor.properties.index') }}" class="text-sm text-blue-600 hover:text-blue-700">View All</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
        <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
            <div class="aspect-video bg-gray-200"></div>
            <div class="p-4">
                <h4 class="font-semibold text-gray-900">Modern Apartment</h4>
                <p class="text-sm text-gray-500">123 Main St</p>
                <p class="text-xl font-bold text-blue-600 mt-2">$325,000</p>
                <div class="flex gap-3 text-xs text-gray-600 mt-2">
                    <span>3 Bed</span>
                    <span>2 Bath</span>
                    <span>1,200 sqft</span>
                </div>
            </div>
        </div>
        <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
            <div class="aspect-video bg-gray-200"></div>
            <div class="p-4">
                <h4 class="font-semibold text-gray-900">Cozy Studio</h4>
                <p class="text-sm text-gray-500">456 Oak Ave</p>
                <p class="text-xl font-bold text-blue-600 mt-2">$185,000</p>
                <div class="flex gap-3 text-xs text-gray-600 mt-2">
                    <span>1 Bed</span>
                    <span>1 Bath</span>
                    <span>600 sqft</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
