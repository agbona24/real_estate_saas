@extends('layouts.dashboard')

@section('page-title', 'My Properties')

@section('page-content')
<div class="flex justify-between items-center mb-6">
    <div class="flex gap-2">
        <select class="px-4 py-2 border border-gray-300 rounded-lg">
            <option>All Properties</option>
            <option>For Sale</option>
            <option>For Rent</option>
            <option>Sold</option>
        </select>
    </div>
    <a href="{{ route('realtor.properties.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Add Property</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
        <div class="aspect-video bg-gray-200 relative">
            <span class="absolute top-3 right-3 px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded">For Sale</span>
        </div>
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-900">Modern Apartment</h3>
            <p class="text-sm text-gray-500 mb-2">123 Main St, Downtown</p>
            <p class="text-2xl font-bold text-blue-600 mb-3">$325,000</p>
            <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
                <span>3 Bed</span>
                <span>2 Bath</span>
                <span>1,200 sqft</span>
            </div>
            <div class="flex gap-2">
                <button class="flex-1 px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">View</button>
                <button class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-50 text-sm">Edit</button>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
        <div class="aspect-video bg-gray-200 relative">
            <span class="absolute top-3 right-3 px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded">For Sale</span>
        </div>
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-900">Cozy Studio</h3>
            <p class="text-sm text-gray-500 mb-2">456 Oak Ave, Midtown</p>
            <p class="text-2xl font-bold text-blue-600 mb-3">$185,000</p>
            <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
                <span>1 Bed</span>
                <span>1 Bath</span>
                <span>600 sqft</span>
            </div>
            <div class="flex gap-2">
                <button class="flex-1 px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">View</button>
                <button class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-50 text-sm">Edit</button>
            </div>
        </div>
    </div>
</div>
@endsection
