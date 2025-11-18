@extends('layouts.dashboard')

@section('page-title', 'My Documents')

@section('page-content')
<div class="flex justify-between items-center mb-6">
    <input type="text" placeholder="Search documents..." class="px-4 py-2 border border-gray-300 rounded-lg w-64">
    <select class="px-4 py-2 border border-gray-300 rounded-lg">
        <option>All Properties</option>
        <option>Modern Apartment</option>
        <option>Downtown Condo</option>
    </select>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                </svg>
            </div>
            <span class="text-xs text-gray-500">PDF</span>
        </div>
        <h4 class="text-sm font-semibold text-gray-900 mb-1">Purchase Agreement</h4>
        <p class="text-xs text-gray-500 mb-3">Modern Apartment</p>
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Download</button>
            <button class="px-3 py-1.5 border border-gray-300 rounded hover:bg-gray-50 text-sm">View</button>
        </div>
        <p class="text-xs text-gray-500 mt-2">Signed on Oct 15, 2024</p>
    </div>

    <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                </svg>
            </div>
            <span class="text-xs text-gray-500">PDF</span>
        </div>
        <h4 class="text-sm font-semibold text-gray-900 mb-1">Title Deed</h4>
        <p class="text-xs text-gray-500 mb-3">Modern Apartment</p>
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Download</button>
            <button class="px-3 py-1.5 border border-gray-300 rounded hover:bg-gray-50 text-sm">View</button>
        </div>
        <p class="text-xs text-gray-500 mt-2">Received on Oct 20, 2024</p>
    </div>

    <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                </svg>
            </div>
            <span class="text-xs text-gray-500">PDF</span>
        </div>
        <h4 class="text-sm font-semibold text-gray-900 mb-1">Inspection Report</h4>
        <p class="text-xs text-gray-500 mb-3">Modern Apartment</p>
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Download</button>
            <button class="px-3 py-1.5 border border-gray-300 rounded hover:bg-gray-50 text-sm">View</button>
        </div>
        <p class="text-xs text-gray-500 mt-2">Created on Oct 10, 2024</p>
    </div>

    <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                </svg>
            </div>
            <span class="text-xs text-gray-500">PDF</span>
        </div>
        <h4 class="text-sm font-semibold text-gray-900 mb-1">Insurance Policy</h4>
        <p class="text-xs text-gray-500 mb-3">Modern Apartment</p>
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Download</button>
            <button class="px-3 py-1.5 border border-gray-300 rounded hover:bg-gray-50 text-sm">View</button>
        </div>
        <p class="text-xs text-gray-500 mt-2">Expires on Oct 15, 2025</p>
    </div>

    <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                </svg>
            </div>
            <span class="text-xs text-gray-500">PDF</span>
        </div>
        <h4 class="text-sm font-semibold text-gray-900 mb-1">Purchase Agreement</h4>
        <p class="text-xs text-gray-500 mb-3">Downtown Condo</p>
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Download</button>
            <button class="px-3 py-1.5 border border-gray-300 rounded hover:bg-gray-50 text-sm">View</button>
        </div>
        <p class="text-xs text-gray-500 mt-2">Signed on May 20, 2023</p>
    </div>

    <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                </svg>
            </div>
            <span class="text-xs text-gray-500">PDF</span>
        </div>
        <h4 class="text-sm font-semibold text-gray-900 mb-1">Title Deed</h4>
        <p class="text-xs text-gray-500 mb-3">Downtown Condo</p>
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Download</button>
            <button class="px-3 py-1.5 border border-gray-300 rounded hover:bg-gray-50 text-sm">View</button>
        </div>
        <p class="text-xs text-gray-500 mt-2">Received on May 25, 2023</p>
    </div>

    <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                </svg>
            </div>
            <span class="text-xs text-gray-500">PDF</span>
        </div>
        <h4 class="text-sm font-semibold text-gray-900 mb-1">HOA Agreement</h4>
        <p class="text-xs text-gray-500 mb-3">Downtown Condo</p>
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Download</button>
            <button class="px-3 py-1.5 border border-gray-300 rounded hover:bg-gray-50 text-sm">View</button>
        </div>
        <p class="text-xs text-gray-500 mt-2">Signed on May 20, 2023</p>
    </div>

    <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                </svg>
            </div>
            <span class="text-xs text-gray-500">PDF</span>
        </div>
        <h4 class="text-sm font-semibold text-gray-900 mb-1">Warranty Deed</h4>
        <p class="text-xs text-gray-500 mb-3">Downtown Condo</p>
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Download</button>
            <button class="px-3 py-1.5 border border-gray-300 rounded hover:bg-gray-50 text-sm">View</button>
        </div>
        <p class="text-xs text-gray-500 mt-2">Received on May 25, 2023</p>
    </div>
</div>
@endsection
