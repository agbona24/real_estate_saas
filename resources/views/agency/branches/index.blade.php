@extends('layouts.dashboard')

@section('page-title', 'Branches')

@section('page-content')
<div class="flex justify-between items-center mb-6">
    <h3 class="text-lg font-semibold text-gray-900">Manage your office locations</h3>
    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Add Branch</button>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
        <div class="flex items-start justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Downtown Office</h3>
            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Main</span>
        </div>
        <div class="space-y-2 mb-4">
            <p class="text-sm text-gray-600">123 Main Street</p>
            <p class="text-sm text-gray-600">Downtown, NY 10001</p>
            <p class="text-sm text-gray-600">+1 (555) 123-4567</p>
        </div>
        <div class="grid grid-cols-2 gap-3 mb-4">
            <div class="bg-blue-50 rounded p-2 text-center">
                <p class="text-lg font-bold text-blue-600">15</p>
                <p class="text-xs text-gray-600">Agents</p>
            </div>
            <div class="bg-green-50 rounded p-2 text-center">
                <p class="text-lg font-bold text-green-600">89</p>
                <p class="text-xs text-gray-600">Properties</p>
            </div>
        </div>
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">View</button>
            <button class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-50 text-sm">Edit</button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
        <div class="flex items-start justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Midtown Branch</h3>
            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">Active</span>
        </div>
        <div class="space-y-2 mb-4">
            <p class="text-sm text-gray-600">456 Park Avenue</p>
            <p class="text-sm text-gray-600">Midtown, NY 10022</p>
            <p class="text-sm text-gray-600">+1 (555) 234-5678</p>
        </div>
        <div class="grid grid-cols-2 gap-3 mb-4">
            <div class="bg-blue-50 rounded p-2 text-center">
                <p class="text-lg font-bold text-blue-600">9</p>
                <p class="text-xs text-gray-600">Agents</p>
            </div>
            <div class="bg-green-50 rounded p-2 text-center">
                <p class="text-lg font-bold text-green-600">67</p>
                <p class="text-xs text-gray-600">Properties</p>
            </div>
        </div>
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">View</button>
            <button class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-50 text-sm">Edit</button>
        </div>
    </div>
</div>
@endsection
