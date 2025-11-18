@extends('layouts.dashboard')

@section('page-title', 'My Leads')

@section('page-content')
<div class="flex justify-between items-center mb-6">
    <div class="flex gap-2" x-data="{ status: 'all' }">
        <button @click="status = 'all'" :class="status === 'all' ? 'bg-blue-600 text-white' : 'bg-white border border-gray-300'" class="px-4 py-2 rounded-lg text-sm">All (12)</button>
        <button @click="status = 'hot'" :class="status === 'hot' ? 'bg-green-600 text-white' : 'bg-white border border-gray-300'" class="px-4 py-2 rounded-lg text-sm">Hot (5)</button>
        <button @click="status = 'warm'" :class="status === 'warm' ? 'bg-blue-600 text-white' : 'bg-white border border-gray-300'" class="px-4 py-2 rounded-lg text-sm">Warm (4)</button>
        <button @click="status = 'cold'" :class="status === 'cold' ? 'bg-gray-600 text-white' : 'bg-white border border-gray-300'" class="px-4 py-2 rounded-lg text-sm">Cold (3)</button>
    </div>
    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Request New Lead</button>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition border-l-4 border-green-500">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Sarah Johnson</h3>
                <p class="text-sm text-gray-500">sarah.j@email.com</p>
                <p class="text-sm text-gray-500">+1 (555) 123-4567</p>
            </div>
            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Hot</span>
        </div>
        <div class="space-y-2 mb-4">
            <p class="text-sm text-gray-600"><span class="font-medium">Type:</span> Apartment</p>
            <p class="text-sm text-gray-600"><span class="font-medium">Budget:</span> $250K - $300K</p>
            <p class="text-sm text-gray-600"><span class="font-medium">Location:</span> Downtown</p>
        </div>
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">View Details</button>
            <button class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition border-l-4 border-blue-500">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">John Davis</h3>
                <p class="text-sm text-gray-500">john.d@email.com</p>
                <p class="text-sm text-gray-500">+1 (555) 234-5678</p>
            </div>
            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">Warm</span>
        </div>
        <div class="space-y-2 mb-4">
            <p class="text-sm text-gray-600"><span class="font-medium">Type:</span> House</p>
            <p class="text-sm text-gray-600"><span class="font-medium">Budget:</span> $500K - $600K</p>
            <p class="text-sm text-gray-600"><span class="font-medium">Location:</span> Suburbs</p>
        </div>
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">View Details</button>
            <button class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition border-l-4 border-gray-500">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Emily Wilson</h3>
                <p class="text-sm text-gray-500">emily.w@email.com</p>
                <p class="text-sm text-gray-500">+1 (555) 345-6789</p>
            </div>
            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">Cold</span>
        </div>
        <div class="space-y-2 mb-4">
            <p class="text-sm text-gray-600"><span class="font-medium">Type:</span> Condo</p>
            <p class="text-sm text-gray-600"><span class="font-medium">Budget:</span> $180K - $220K</p>
            <p class="text-sm text-gray-600"><span class="font-medium">Location:</span> Midtown</p>
        </div>
        <div class="flex gap-2">
            <button class="flex-1 px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">View Details</button>
            <button class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
