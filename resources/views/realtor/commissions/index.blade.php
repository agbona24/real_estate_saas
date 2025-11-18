@extends('layouts.dashboard')

@section('page-title', 'My Commissions')

@section('page-content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-600">Total Earned</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">$62,450</p>
        <p class="text-sm text-gray-500 mt-1">All time</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-600">This Month</p>
        <p class="text-3xl font-bold text-green-600 mt-2">$8,500</p>
        <p class="text-sm text-gray-500 mt-1">+15% vs last month</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-600">This Year</p>
        <p class="text-3xl font-bold text-blue-600 mt-2">$45,200</p>
        <p class="text-sm text-gray-500 mt-1">12 transactions</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-600">Avg Commission</p>
        <p class="text-3xl font-bold text-purple-600 mt-2">$3,767</p>
        <p class="text-sm text-gray-500 mt-1">Per transaction</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-900">Commission History</h3>
        <button class="text-sm text-blue-600 hover:text-blue-800">Download Report</button>
    </div>
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Property</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sale Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rate</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commission</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">Modern Apartment, 123 Main St</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$162,500</td>
                <td class="px-6 py-4 text-sm text-gray-900">3%</td>
                <td class="px-6 py-4 text-sm font-bold text-green-600">$4,875</td>
                <td class="px-6 py-4 text-sm text-gray-500">Nov 15, 2025</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span></td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">Downtown Condo, 456 Oak Ave</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$120,000</td>
                <td class="px-6 py-4 text-sm text-gray-900">3%</td>
                <td class="px-6 py-4 text-sm font-bold text-green-600">$3,600</td>
                <td class="px-6 py-4 text-sm text-gray-500">Nov 10, 2025</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span></td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">Family Home, 789 Elm St</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$212,500</td>
                <td class="px-6 py-4 text-sm text-gray-900">3%</td>
                <td class="px-6 py-4 text-sm font-bold text-blue-600">$6,375</td>
                <td class="px-6 py-4 text-sm text-gray-500">Nov 5, 2025</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Pending</span></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
