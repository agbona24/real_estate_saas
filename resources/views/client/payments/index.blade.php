@extends('layouts.dashboard')

@section('page-title', 'Payment History')

@section('page-content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm font-medium text-gray-600">Total Paid</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">$48,500</p>
        <p class="text-sm text-gray-500 mt-1">All properties</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm font-medium text-gray-600">This Month</p>
        <p class="text-3xl font-bold text-green-600 mt-2">$3,250</p>
        <p class="text-sm text-gray-500 mt-1">2 payments made</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm font-medium text-gray-600">Next Payment</p>
        <p class="text-3xl font-bold text-blue-600 mt-2">$3,200</p>
        <p class="text-sm text-gray-500 mt-1">Due Dec 15, 2025</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-900">Payment History</h3>
        <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm">
            <option>All Properties</option>
            <option>Modern Apartment</option>
            <option>Downtown Condo</option>
        </select>
    </div>
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Property</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Receipt</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">Nov 15, 2025</td>
                <td class="px-6 py-4 text-sm text-gray-900">Modern Apartment</td>
                <td class="px-6 py-4 text-sm text-gray-900">Monthly Mortgage Payment</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$1,625</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span></td>
                <td class="px-6 py-4"><button class="text-blue-600 hover:text-blue-800 text-sm">Download</button></td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">Nov 15, 2025</td>
                <td class="px-6 py-4 text-sm text-gray-900">Downtown Condo</td>
                <td class="px-6 py-4 text-sm text-gray-900">Monthly Mortgage Payment</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$2,100</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span></td>
                <td class="px-6 py-4"><button class="text-blue-600 hover:text-blue-800 text-sm">Download</button></td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">Nov 10, 2025</td>
                <td class="px-6 py-4 text-sm text-gray-900">Downtown Condo</td>
                <td class="px-6 py-4 text-sm text-gray-900">HOA Fees</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$450</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span></td>
                <td class="px-6 py-4"><button class="text-blue-600 hover:text-blue-800 text-sm">Download</button></td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">Oct 15, 2025</td>
                <td class="px-6 py-4 text-sm text-gray-900">Modern Apartment</td>
                <td class="px-6 py-4 text-sm text-gray-900">Monthly Mortgage Payment</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$1,625</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span></td>
                <td class="px-6 py-4"><button class="text-blue-600 hover:text-blue-800 text-sm">Download</button></td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">Oct 15, 2025</td>
                <td class="px-6 py-4 text-sm text-gray-900">Downtown Condo</td>
                <td class="px-6 py-4 text-sm text-gray-900">Monthly Mortgage Payment</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$2,100</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span></td>
                <td class="px-6 py-4"><button class="text-blue-600 hover:text-blue-800 text-sm">Download</button></td>
            </tr>
        </tbody>
    </table>

    <div class="px-6 py-4 border-t border-gray-200">
        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-500">Showing 5 of 48 payments</p>
            <div class="flex gap-2">
                <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50">Previous</button>
                <button class="px-3 py-1 bg-blue-600 text-white rounded">1</button>
                <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50">2</button>
                <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50">3</button>
                <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50">Next</button>
            </div>
        </div>
    </div>
</div>
@endsection
