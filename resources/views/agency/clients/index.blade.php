@extends('layouts.dashboard')

@section('page-title', 'Clients Management')

@section('page-content')
<div class="flex justify-between items-center mb-6">
    <input type="text" placeholder="Search clients..." class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 w-64">
    <a href="{{ route('agency.clients.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Add Client
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Properties</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Value</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                            MJ
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Michael Johnson</p>
                            <p class="text-sm text-gray-500">michael.j@email.com</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-900">Buyer</td>
                <td class="px-6 py-4 text-sm text-gray-900">2</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$850,000</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                </td>
                <td class="px-6 py-4">
                    <button class="text-blue-600 hover:text-blue-800">View</button>
                </td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-semibold">
                            ST
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Sarah Thompson</p>
                            <p class="text-sm text-gray-500">sarah.t@email.com</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-900">Seller</td>
                <td class="px-6 py-4 text-sm text-gray-900">1</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$425,000</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                </td>
                <td class="px-6 py-4">
                    <button class="text-blue-600 hover:text-blue-800">View</button>
                </td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold">
                            DW
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">David Williams</p>
                            <p class="text-sm text-gray-500">david.w@email.com</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-900">Both</td>
                <td class="px-6 py-4 text-sm text-gray-900">3</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$1,250,000</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Prospect</span>
                </td>
                <td class="px-6 py-4">
                    <button class="text-blue-600 hover:text-blue-800">View</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
