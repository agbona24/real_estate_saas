@extends('layouts.dashboard')

@section('page-title', 'My Properties')

@section('page-content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
        <div class="aspect-video bg-gray-200 relative">
            <span class="absolute top-3 right-3 px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded">Owned</span>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Modern Apartment</h3>
            <p class="text-sm text-gray-500 mb-4">123 Main St, Downtown</p>
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-600">3</p>
                    <p class="text-xs text-gray-600">Bedrooms</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-600">2</p>
                    <p class="text-xs text-gray-600">Bathrooms</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-600">1.2K</p>
                    <p class="text-xs text-gray-600">sqft</p>
                </div>
            </div>
            <div class="border-t pt-4 space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Purchase Price</span>
                    <span class="font-medium text-gray-900">$325,000</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Purchase Date</span>
                    <span class="font-medium text-gray-900">Oct 15, 2024</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Agent</span>
                    <span class="font-medium text-gray-900">Mike Smith</span>
                </div>
            </div>
            <button class="mt-4 w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">View Details</button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
        <div class="aspect-video bg-gray-200 relative">
            <span class="absolute top-3 right-3 px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded">Owned</span>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Downtown Condo</h3>
            <p class="text-sm text-gray-500 mb-4">456 Oak Ave, Midtown</p>
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-600">2</p>
                    <p class="text-xs text-gray-600">Bedrooms</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-600">2</p>
                    <p class="text-xs text-gray-600">Bathrooms</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-600">950</p>
                    <p class="text-xs text-gray-600">sqft</p>
                </div>
            </div>
            <div class="border-t pt-4 space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Purchase Price</span>
                    <span class="font-medium text-gray-900">$525,000</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Purchase Date</span>
                    <span class="font-medium text-gray-900">May 20, 2023</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Agent</span>
                    <span class="font-medium text-gray-900">Lisa Brown</span>
                </div>
            </div>
            <button class="mt-4 w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">View Details</button>
        </div>
    </div>
</div>
@endsection
