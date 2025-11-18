@extends('layouts.dashboard')

@section('page-title', 'Transactions')

@section('page-content')
<div class="flex justify-between items-center mb-6">
    <div class="flex gap-2">
        <select class="px-4 py-2 border border-gray-300 rounded-lg">
            <option>All Statuses</option>
            <option>Pending</option>
            <option>In Progress</option>
            <option>Completed</option>
        </select>
    </div>
    <a href="{{ route('agency.transactions.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">New Transaction</a>
</div>

<div class="bg-white rounded-lg shadow">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Property</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">Modern Apartment, 123 Main St</td>
                <td class="px-6 py-4 text-sm text-gray-900">Michael Johnson</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$325,000</td>
                <td class="px-6 py-4 text-sm text-gray-900">Sale</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span></td>
                <td class="px-6 py-4 text-sm text-gray-500">Nov 15, 2025</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">Luxury Villa, 456 Oak Ave</td>
                <td class="px-6 py-4 text-sm text-gray-900">Sarah Thompson</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$3,500/mo</td>
                <td class="px-6 py-4 text-sm text-gray-900">Rental</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">In Progress</span></td>
                <td class="px-6 py-4 text-sm text-gray-500">Nov 16, 2025</td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">Family Home, 789 Elm St</td>
                <td class="px-6 py-4 text-sm text-gray-900">David Williams</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$425,000</td>
                <td class="px-6 py-4 text-sm text-gray-900">Sale</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span></td>
                <td class="px-6 py-4 text-sm text-gray-500">Nov 17, 2025</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
