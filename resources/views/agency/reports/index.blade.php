@extends('layouts.dashboard')

@section('page-title', 'Reports & Analytics')

@section('page-content')
<div class="flex justify-between items-center mb-6">
    <div class="flex gap-2">
        <select class="px-4 py-2 border border-gray-300 rounded-lg">
            <option>Last 30 Days</option>
            <option>Last 3 Months</option>
            <option>Last Year</option>
            <option>Custom Range</option>
        </select>
    </div>
    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Export Report</button>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-600">Total Revenue</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">$245,680</p>
        <p class="text-sm text-green-600 mt-2">+18.2% vs last period</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-600">Properties Sold</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">42</p>
        <p class="text-sm text-green-600 mt-2">+12.5% vs last period</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-600">New Leads</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">156</p>
        <p class="text-sm text-green-600 mt-2">+24.3% vs last period</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-sm text-gray-600">Conversion Rate</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">26.9%</p>
        <p class="text-sm text-red-600 mt-2">-2.1% vs last period</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Revenue by Property Type</h3>
        <div class="h-64 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg">
            <p class="text-gray-500">Chart Placeholder - Integrate with Chart.js</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Monthly Sales Trend</h3>
        <div class="h-64 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg">
            <p class="text-gray-500">Chart Placeholder - Integrate with Chart.js</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Performing Realtors</h3>
    <table class="w-full">
        <thead class="border-b">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Realtor</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Properties Sold</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Revenue</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commission</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <tr>
                <td class="px-4 py-3 text-sm text-gray-900">Lisa Brown</td>
                <td class="px-4 py-3 text-sm text-gray-900">12</td>
                <td class="px-4 py-3 text-sm font-medium text-gray-900">$1,245,000</td>
                <td class="px-4 py-3 text-sm text-gray-900">$62,250</td>
            </tr>
            <tr>
                <td class="px-4 py-3 text-sm text-gray-900">Mike Smith</td>
                <td class="px-4 py-3 text-sm text-gray-900">10</td>
                <td class="px-4 py-3 text-sm font-medium text-gray-900">$985,000</td>
                <td class="px-4 py-3 text-sm text-gray-900">$49,250</td>
            </tr>
            <tr>
                <td class="px-4 py-3 text-sm text-gray-900">Robert Taylor</td>
                <td class="px-4 py-3 text-sm text-gray-900">8</td>
                <td class="px-4 py-3 text-sm font-medium text-gray-900">$768,000</td>
                <td class="px-4 py-3 text-sm text-gray-900">$38,400</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
