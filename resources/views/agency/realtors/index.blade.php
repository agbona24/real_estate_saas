@extends('layouts.dashboard')

@section('page-title', 'Realtors Management')

@section('page-content')
<!-- Header Actions -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <div class="flex-1 w-full sm:w-auto">
        <div class="relative">
            <input type="text" placeholder="Search realtors..."
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>
    <div class="flex gap-3">
        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Export
        </button>
        <a href="{{ route('agency.realtors.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Realtor
        </a>
    </div>
</div>

<!-- Realtors Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Realtor Card 1 -->
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white text-xl font-semibold">
                        MS
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-semibold text-gray-900">Mike Smith</h3>
                        <p class="text-sm text-gray-500">Senior Agent</p>
                    </div>
                </div>
                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
            </div>
            <div class="space-y-2 mb-4">
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    mike.smith@agency.com
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    +1 (555) 123-4567
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                <div class="bg-blue-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-blue-600">24</p>
                    <p class="text-xs text-gray-600">Properties</p>
                </div>
                <div class="bg-green-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-green-600">12</p>
                    <p class="text-xs text-gray-600">Leads</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-purple-600">$45K</p>
                    <p class="text-xs text-gray-600">Revenue</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="#" class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium text-center">View Profile</a>
                <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Realtor Card 2 -->
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center text-white text-xl font-semibold">
                        LB
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-semibold text-gray-900">Lisa Brown</h3>
                        <p class="text-sm text-gray-500">Team Lead</p>
                    </div>
                </div>
                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
            </div>
            <div class="space-y-2 mb-4">
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    lisa.brown@agency.com
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    +1 (555) 234-5678
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                <div class="bg-blue-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-blue-600">32</p>
                    <p class="text-xs text-gray-600">Properties</p>
                </div>
                <div class="bg-green-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-green-600">18</p>
                    <p class="text-xs text-gray-600">Leads</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-purple-600">$62K</p>
                    <p class="text-xs text-gray-600">Revenue</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="#" class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium text-center">View Profile</a>
                <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Realtor Card 3 -->
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center text-white text-xl font-semibold">
                        JD
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-semibold text-gray-900">John Davis</h3>
                        <p class="text-sm text-gray-500">Agent</p>
                    </div>
                </div>
                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
            </div>
            <div class="space-y-2 mb-4">
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    john.davis@agency.com
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    +1 (555) 345-6789
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                <div class="bg-blue-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-blue-600">18</p>
                    <p class="text-xs text-gray-600">Properties</p>
                </div>
                <div class="bg-green-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-green-600">9</p>
                    <p class="text-xs text-gray-600">Leads</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-purple-600">$38K</p>
                    <p class="text-xs text-gray-600">Revenue</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="#" class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium text-center">View Profile</a>
                <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Realtor Card 4 -->
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center text-white text-xl font-semibold">
                        SW
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-semibold text-gray-900">Sarah Wilson</h3>
                        <p class="text-sm text-gray-500">Junior Agent</p>
                    </div>
                </div>
                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Training</span>
            </div>
            <div class="space-y-2 mb-4">
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    sarah.wilson@agency.com
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    +1 (555) 456-7890
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                <div class="bg-blue-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-blue-600">6</p>
                    <p class="text-xs text-gray-600">Properties</p>
                </div>
                <div class="bg-green-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-green-600">4</p>
                    <p class="text-xs text-gray-600">Leads</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-purple-600">$12K</p>
                    <p class="text-xs text-gray-600">Revenue</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="#" class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium text-center">View Profile</a>
                <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Realtor Card 5 -->
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-indigo-500 rounded-full flex items-center justify-center text-white text-xl font-semibold">
                        RT
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-semibold text-gray-900">Robert Taylor</h3>
                        <p class="text-sm text-gray-500">Agent</p>
                    </div>
                </div>
                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
            </div>
            <div class="space-y-2 mb-4">
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    robert.taylor@agency.com
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    +1 (555) 567-8901
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                <div class="bg-blue-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-blue-600">21</p>
                    <p class="text-xs text-gray-600">Properties</p>
                </div>
                <div class="bg-green-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-green-600">14</p>
                    <p class="text-xs text-gray-600">Leads</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-purple-600">$52K</p>
                    <p class="text-xs text-gray-600">Revenue</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="#" class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium text-center">View Profile</a>
                <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Realtor Card 6 -->
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
        <div class="p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-pink-500 rounded-full flex items-center justify-center text-white text-xl font-semibold">
                        EM
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-semibold text-gray-900">Emma Martinez</h3>
                        <p class="text-sm text-gray-500">Agent</p>
                    </div>
                </div>
                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Inactive</span>
            </div>
            <div class="space-y-2 mb-4">
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    emma.martinez@agency.com
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    +1 (555) 678-9012
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                <div class="bg-blue-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-blue-600">15</p>
                    <p class="text-xs text-gray-600">Properties</p>
                </div>
                <div class="bg-green-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-green-600">6</p>
                    <p class="text-xs text-gray-600">Leads</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-2">
                    <p class="text-xl font-bold text-purple-600">$28K</p>
                    <p class="text-xs text-gray-600">Revenue</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="#" class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium text-center">View Profile</a>
                <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
