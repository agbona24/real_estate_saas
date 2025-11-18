@extends('layouts.dashboard')

@section('page-title', 'Leads Management')

@section('page-content')
<!-- Header with Filters -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <div class="flex gap-2" x-data="{ status: 'all' }">
        <button @click="status = 'all'" :class="status === 'all' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 border border-gray-300'" class="px-4 py-2 rounded-lg hover:bg-blue-50 text-sm font-medium">
            All (48)
        </button>
        <button @click="status = 'hot'" :class="status === 'hot' ? 'bg-green-600 text-white' : 'bg-white text-gray-700 border border-gray-300'" class="px-4 py-2 rounded-lg hover:bg-green-50 text-sm font-medium">
            Hot (12)
        </button>
        <button @click="status = 'warm'" :class="status === 'warm' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 border border-gray-300'" class="px-4 py-2 rounded-lg hover:bg-blue-50 text-sm font-medium">
            Warm (18)
        </button>
        <button @click="status = 'cold'" :class="status === 'cold' ? 'bg-yellow-600 text-white' : 'bg-white text-gray-700 border border-gray-300'" class="px-4 py-2 rounded-lg hover:bg-yellow-50 text-sm font-medium">
            Cold (18)
        </button>
    </div>
    <div class="flex gap-3">
        <input type="text" placeholder="Search leads..." class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <a href="{{ route('agency.leads.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Lead
        </a>
    </div>
</div>

<!-- Leads Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left">
                        <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Property Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Budget</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Assigned To</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Sarah Johnson</p>
                            <p class="text-sm text-gray-500">sarah.j@email.com</p>
                            <p class="text-sm text-gray-500">+1 (555) 123-4567</p>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">Apartment</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">$250K - $300K</td>
                    <td class="px-6 py-4 text-sm text-gray-900">Downtown</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Hot</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                MS
                            </div>
                            <span class="ml-2 text-sm text-gray-900">Mike Smith</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">Nov 16, 2025</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <button class="p-1 text-blue-600 hover:bg-blue-50 rounded">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button class="p-1 text-green-600 hover:bg-green-50 rounded">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <p class="text-sm font-medium text-gray-900">John Davis</p>
                            <p class="text-sm text-gray-500">john.d@email.com</p>
                            <p class="text-sm text-gray-500">+1 (555) 234-5678</p>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">House</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">$500K - $600K</td>
                    <td class="px-6 py-4 text-sm text-gray-900">Suburbs</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Warm</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                LB
                            </div>
                            <span class="ml-2 text-sm text-gray-900">Lisa Brown</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">Nov 15, 2025</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <button class="p-1 text-blue-600 hover:bg-blue-50 rounded">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button class="p-1 text-green-600 hover:bg-green-50 rounded">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Emily Wilson</p>
                            <p class="text-sm text-gray-500">emily.w@email.com</p>
                            <p class="text-sm text-gray-500">+1 (555) 345-6789</p>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">Condo</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">$180K - $220K</td>
                    <td class="px-6 py-4 text-sm text-gray-900">Midtown</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Cold</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded bg-gray-100 text-gray-600">Unassigned</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">Nov 14, 2025</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <button class="p-1 text-blue-600 hover:bg-blue-50 rounded">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button class="p-1 text-green-600 hover:bg-green-50 rounded">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
        <div class="text-sm text-gray-500">
            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">48</span> results
        </div>
        <div class="flex gap-2">
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50 disabled:opacity-50" disabled>Previous</button>
            <button class="px-3 py-1 bg-blue-600 text-white rounded">1</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50">2</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50">3</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50">Next</button>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
