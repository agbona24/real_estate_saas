@extends('layouts.dashboard')

@section('page-title', 'Payment History')

@section('page-content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm font-medium text-gray-600">Current Plan</p>
        <p class="text-2xl font-bold text-gray-900 mt-2">Professional</p>
        <p class="text-sm text-gray-500 mt-1">$299/month</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm font-medium text-gray-600">Next Payment</p>
        <p class="text-2xl font-bold text-gray-900 mt-2">Dec 18, 2025</p>
        <p class="text-sm text-gray-500 mt-1">In 30 days</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm font-medium text-gray-600">Total Paid</p>
        <p class="text-2xl font-bold text-gray-900 mt-2">$3,588</p>
        <p class="text-sm text-gray-500 mt-1">Last 12 months</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-900">Payment History</h3>
        <button class="text-sm text-blue-600 hover:text-blue-800">Download All</button>
    </div>
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Invoice</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm font-mono text-gray-900">#INV-2025-011</td>
                <td class="px-6 py-4 text-sm text-gray-900">Nov 18, 2025</td>
                <td class="px-6 py-4 text-sm text-gray-900">Professional Plan - Monthly</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$299.00</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span></td>
                <td class="px-6 py-4"><button class="text-blue-600 hover:text-blue-800 text-sm">Download</button></td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm font-mono text-gray-900">#INV-2025-010</td>
                <td class="px-6 py-4 text-sm text-gray-900">Oct 18, 2025</td>
                <td class="px-6 py-4 text-sm text-gray-900">Professional Plan - Monthly</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$299.00</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span></td>
                <td class="px-6 py-4"><button class="text-blue-600 hover:text-blue-800 text-sm">Download</button></td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm font-mono text-gray-900">#INV-2025-009</td>
                <td class="px-6 py-4 text-sm text-gray-900">Sep 18, 2025</td>
                <td class="px-6 py-4 text-sm text-gray-900">Professional Plan - Monthly</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$299.00</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span></td>
                <td class="px-6 py-4"><button class="text-blue-600 hover:text-blue-800 text-sm">Download</button></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
