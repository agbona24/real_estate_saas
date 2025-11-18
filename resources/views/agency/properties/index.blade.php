@extends('layouts.dashboard')

@section('page-title', 'Properties Management')

@section('page-content')
<div class="flex justify-between items-center mb-6">
    <div class="flex gap-2" x-data="{ type: 'all' }">
        <button @click="type = 'all'" :class="type === 'all' ? 'bg-blue-600 text-white' : 'bg-white border border-gray-300'" class="px-4 py-2 rounded-lg text-sm">All (156)</button>
        <button @click="type = 'sale'" :class="type === 'sale' ? 'bg-green-600 text-white' : 'bg-white border border-gray-300'" class="px-4 py-2 rounded-lg text-sm">For Sale (98)</button>
        <button @click="type = 'rent'" :class="type === 'rent' ? 'bg-blue-600 text-white' : 'bg-white border border-gray-300'" class="px-4 py-2 rounded-lg text-sm">For Rent (42)</button>
        <button @click="type = 'sold'" :class="type === 'sold' ? 'bg-purple-600 text-white' : 'bg-white border border-gray-300'" class="px-4 py-2 rounded-lg text-sm">Sold (16)</button>
    </div>
    <a href="{{ route('agency.properties.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Add Property</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        <div class="aspect-video bg-gray-200 relative">
            <span class="absolute top-3 right-3 px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded">For Sale</span>
        </div>
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-1">Modern Apartment</h3>
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

    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        <div class="aspect-video bg-gray-200 relative">
            <span class="absolute top-3 right-3 px-2 py-1 bg-blue-600 text-white text-xs font-semibold rounded">For Rent</span>
        </div>
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-1">Luxury Villa</h3>
            <p class="text-sm text-gray-500 mb-2">456 Oak Ave, Suburbs</p>
            <p class="text-2xl font-bold text-blue-600 mb-3">$3,500/mo</p>
            <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
                <span>4 Bed</span>
                <span>3 Bath</span>
                <span>2,500 sqft</span>
            </div>
            <div class="flex gap-2">
                <button class="flex-1 px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">View</button>
                <button class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-50 text-sm">Edit</button>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        <div class="aspect-video bg-gray-200 relative">
            <span class="absolute top-3 right-3 px-2 py-1 bg-purple-600 text-white text-xs font-semibold rounded">Sold</span>
        </div>
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-1">Family Home</h3>
            <p class="text-sm text-gray-500 mb-2">789 Elm St, Northside</p>
            <p class="text-2xl font-bold text-gray-400 mb-3">$425,000</p>
            <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
                <span>5 Bed</span>
                <span>3 Bath</span>
                <span>3,200 sqft</span>
            </div>
            <div class="flex gap-2">
                <button class="flex-1 px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">View</button>
                <button class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-50 text-sm">Edit</button>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
