@extends('layouts.dashboard')

@section('page-title', 'Client Dashboard')

@section('page-content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">My Properties</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">2</p>
                <p class="text-sm text-gray-500 mt-2">Active properties</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total Value</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">$850K</p>
                <p class="text-sm text-gray-500 mt-2">Portfolio value</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Documents</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">8</p>
                <p class="text-sm text-gray-500 mt-2">Signed documents</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Next Payment</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">$3.2K</p>
                <p class="text-sm text-gray-500 mt-2">Due in 15 days</p>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="lg:col-span-2 bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">My Properties</h3>
        </div>
        <div class="p-6 space-y-4">
            <div class="flex items-start gap-4 p-4 border border-gray-200 rounded-lg hover:border-blue-500 transition">
                <div class="w-24 h-24 bg-gray-200 rounded-lg"></div>
                <div class="flex-1">
                    <h4 class="text-lg font-semibold text-gray-900">Modern Apartment</h4>
                    <p class="text-sm text-gray-500">123 Main St, Downtown</p>
                    <div class="flex items-center gap-4 mt-2 text-sm text-gray-600">
                        <span>3 Bed</span>
                        <span>2 Bath</span>
                        <span>1,200 sqft</span>
                    </div>
                    <div class="flex items-center justify-between mt-3">
                        <p class="text-xl font-bold text-blue-600">$325,000</p>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Purchased</span>
                    </div>
                </div>
            </div>

            <div class="flex items-start gap-4 p-4 border border-gray-200 rounded-lg hover:border-blue-500 transition">
                <div class="w-24 h-24 bg-gray-200 rounded-lg"></div>
                <div class="flex-1">
                    <h4 class="text-lg font-semibold text-gray-900">Downtown Condo</h4>
                    <p class="text-sm text-gray-500">456 Oak Ave, Midtown</p>
                    <div class="flex items-center gap-4 mt-2 text-sm text-gray-600">
                        <span>2 Bed</span>
                        <span>2 Bath</span>
                        <span>950 sqft</span>
                    </div>
                    <div class="flex items-center justify-between mt-3">
                        <p class="text-xl font-bold text-blue-600">$525,000</p>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Purchased</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
        </div>
        <div class="p-6 space-y-3">
            <a href="{{ route('client.properties.index') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">View Properties</p>
                    <p class="text-xs text-gray-500">See all your properties</p>
                </div>
            </a>

            <a href="{{ route('client.documents.index') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-green-500 hover:bg-green-50 transition">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">My Documents</p>
                    <p class="text-xs text-gray-500">Access signed documents</p>
                </div>
            </a>

            <a href="{{ route('client.payments.index') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-purple-500 hover:bg-purple-50 transition">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">Payment History</p>
                    <p class="text-xs text-gray-500">View all payments</p>
                </div>
            </a>

            <a href="{{ route('client.support') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-orange-500 hover:bg-orange-50 transition">
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">Contact Support</p>
                    <p class="text-xs text-gray-500">Get help & assistance</p>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b">
        <h3 class="text-lg font-semibold text-gray-900">Recent Payments</h3>
    </div>
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Property</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">Nov 15, 2025</td>
                <td class="px-6 py-4 text-sm text-gray-900">Modern Apartment</td>
                <td class="px-6 py-4 text-sm text-gray-900">Monthly Mortgage Payment</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$1,625</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span></td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-900">Nov 10, 2025</td>
                <td class="px-6 py-4 text-sm text-gray-900">Downtown Condo</td>
                <td class="px-6 py-4 text-sm text-gray-900">HOA Fees</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">$450</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
