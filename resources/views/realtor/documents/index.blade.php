@extends('layouts.dashboard')

@section('page-title', 'My Documents')

@section('page-content')
<div class="flex justify-between items-center mb-6">
    <input type="text" placeholder="Search documents..." class="px-4 py-2 border border-gray-300 rounded-lg w-64">
    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Upload Document</button>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                </svg>
            </div>
            <span class="text-xs text-gray-500">PDF</span>
        </div>
        <h4 class="text-sm font-semibold text-gray-900 mb-1">License Certificate</h4>
        <p class="text-xs text-gray-500 mb-3">Valid until 2026</p>
        <button class="w-full px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Download</button>
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
        <h4 class="text-sm font-semibold text-gray-900 mb-1">Purchase Agreement</h4>
        <p class="text-xs text-gray-500 mb-3">Modern Apartment</p>
        <button class="w-full px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Download</button>
    </div>

    <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                </svg>
            </div>
            <span class="text-xs text-gray-500">DOC</span>
        </div>
        <h4 class="text-sm font-semibold text-gray-900 mb-1">Listing Agreement</h4>
        <p class="text-xs text-gray-500 mb-3">Cozy Studio</p>
        <button class="w-full px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Download</button>
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
        <h4 class="text-sm font-semibold text-gray-900 mb-1">Commission Report</h4>
        <p class="text-xs text-gray-500 mb-3">Q4 2025</p>
        <button class="w-full px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Download</button>
    </div>
</div>
@endsection
