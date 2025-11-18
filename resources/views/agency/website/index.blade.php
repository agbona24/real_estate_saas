@extends('layouts.dashboard')

@section('page-title', 'Website Builder')

@section('page-content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Website Status</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">Domain</span>
                <span class="text-sm font-medium text-blue-600">agency.realestate.com</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">Status</span>
                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Published</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">Theme</span>
                <span class="text-sm font-medium text-gray-900">Modern Estate</span>
            </div>
        </div>
        <button class="mt-4 w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Visit Website</button>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Stats</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">Total Visits</span>
                <span class="text-lg font-bold text-gray-900">12,458</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">This Month</span>
                <span class="text-lg font-bold text-green-600">+2,345</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">Inquiries</span>
                <span class="text-lg font-bold text-blue-600">248</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">SEO Score</h3>
        <div class="flex items-center justify-center mb-4">
            <div class="relative w-32 h-32">
                <svg class="w-full h-full" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#e5e7eb" stroke-width="10"></circle>
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#10b981" stroke-width="10" stroke-dasharray="283" stroke-dashoffset="70" transform="rotate(-90 50 50)"></circle>
                </svg>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-3xl font-bold text-gray-900">85</span>
                </div>
            </div>
        </div>
        <p class="text-sm text-center text-gray-600">Good SEO performance</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b">
        <h3 class="text-lg font-semibold text-gray-900">Website Pages</h3>
    </div>
    <div class="p-6 space-y-3">
        <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
            <div>
                <p class="font-medium text-gray-900">Home Page</p>
                <p class="text-sm text-gray-500">Main landing page</p>
            </div>
            <button class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Edit</button>
        </div>
        <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
            <div>
                <p class="font-medium text-gray-900">Properties Listing</p>
                <p class="text-sm text-gray-500">Browse all properties</p>
            </div>
            <button class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Edit</button>
        </div>
        <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
            <div>
                <p class="font-medium text-gray-900">About Us</p>
                <p class="text-sm text-gray-500">Company information</p>
            </div>
            <button class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Edit</button>
        </div>
        <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
            <div>
                <p class="font-medium text-gray-900">Contact</p>
                <p class="text-sm text-gray-500">Contact form and details</p>
            </div>
            <button class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Edit</button>
        </div>
    </div>
</div>
@endsection
