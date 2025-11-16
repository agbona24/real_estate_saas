@extends('layouts.app')

@section('title', 'Subscription & Billing')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-credit-card mr-2 text-indigo-600"></i>
                Subscription & Billing
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Manage your subscription plan and billing information
            </p>
        </div>
    </div>

    <!-- Current Plan Overview -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg shadow-xl p-8 text-white">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-indigo-100 text-sm mb-2">Current Plan</p>
                <h2 class="text-4xl font-bold mb-4">{{ $currentPlan->name ?? 'Professional Plan' }}</h2>
                <div class="flex items-baseline space-x-2 mb-4">
                    <span class="text-5xl font-bold">${{ $currentPlan->price ?? 99 }}</span>
                    <span class="text-indigo-100">/{{ $currentPlan->interval ?? 'month' }}</span>
                </div>
                <div class="flex items-center space-x-4 text-sm">
                    <span class="flex items-center">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Next billing: {{ $subscription->next_billing ?? 'Dec 15, 2025' }}
                    </span>
                    <span class="flex items-center px-3 py-1 bg-white bg-opacity-20 rounded-full">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ ucfirst($subscription->status ?? 'active') }}
                    </span>
                </div>
            </div>
            <div>
                <button onclick="window.location.href='{{ route('agency.subscription.plans') }}'" class="bg-white text-indigo-600 hover:bg-indigo-50 px-6 py-3 rounded-lg font-semibold shadow-lg">
                    <i class="fas fa-exchange-alt mr-2"></i>
                    Change Plan
                </button>
            </div>
        </div>
    </div>

    <!-- Usage Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm font-medium text-gray-600">Users</p>
                <i class="fas fa-users text-blue-500 text-xl"></i>
            </div>
            <div class="flex items-baseline space-x-2">
                <p class="text-2xl font-bold text-gray-900">{{ $usage['users'] ?? 8 }}</p>
                <p class="text-sm text-gray-500">/ {{ $limits['users'] ?? 15 }}</p>
            </div>
            <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($usage['users'] ?? 8) / ($limits['users'] ?? 15) * 100 }}%"></div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm font-medium text-gray-600">Properties</p>
                <i class="fas fa-home text-green-500 text-xl"></i>
            </div>
            <div class="flex items-baseline space-x-2">
                <p class="text-2xl font-bold text-gray-900">{{ $usage['properties'] ?? 245 }}</p>
                <p class="text-sm text-gray-500">/ {{ $limits['properties'] ?? 500 }}</p>
            </div>
            <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
                <div class="bg-green-600 h-2 rounded-full" style="width: {{ ($usage['properties'] ?? 245) / ($limits['properties'] ?? 500) * 100 }}%"></div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm font-medium text-gray-600">Storage</p>
                <i class="fas fa-hdd text-purple-500 text-xl"></i>
            </div>
            <div class="flex items-baseline space-x-2">
                <p class="text-2xl font-bold text-gray-900">{{ $usage['storage'] ?? 3.2 }}</p>
                <p class="text-sm text-gray-500">GB / {{ $limits['storage'] ?? 10 }} GB</p>
            </div>
            <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
                <div class="bg-purple-600 h-2 rounded-full" style="width: {{ ($usage['storage'] ?? 3.2) / ($limits['storage'] ?? 10) * 100 }}%"></div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm font-medium text-gray-600">API Calls</p>
                <i class="fas fa-plug text-yellow-500 text-xl"></i>
            </div>
            <div class="flex items-baseline space-x-2">
                <p class="text-2xl font-bold text-gray-900">{{ $usage['api_calls'] ?? '12K' }}</p>
                <p class="text-sm text-gray-500">/ {{ $limits['api_calls'] ?? '50K' }}</p>
            </div>
            <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
                <div class="bg-yellow-600 h-2 rounded-full" style="width: 24%"></div>
            </div>
        </div>
    </div>

    <!-- Billing History & Payment Method -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Payment Method -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-credit-card mr-2 text-gray-600"></i>
                    Payment Method
                </h2>
                <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                    <i class="fas fa-plus mr-1"></i> Add New
                </button>
            </div>
            <div class="p-6">
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-3 text-white mr-4">
                                <i class="fab fa-cc-visa text-2xl"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Visa ending in 4242</p>
                                <p class="text-sm text-gray-500">Expires 12/2025</p>
                                <span class="inline-flex items-center px-2 py-1 mt-2 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i> Default
                                </span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-700 p-1">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-700 p-1">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Billing Address -->
                <div class="mt-6">
                    <h3 class="font-medium text-gray-900 mb-3">Billing Address</h3>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p>{{ $billingAddress->name ?? 'John Doe' }}</p>
                        <p>{{ $billingAddress->address ?? '123 Main Street' }}</p>
                        <p>{{ $billingAddress->city ?? 'Los Angeles' }}, {{ $billingAddress->state ?? 'CA' }} {{ $billingAddress->zip ?? '90210' }}</p>
                        <p>{{ $billingAddress->country ?? 'United States' }}</p>
                    </div>
                    <button class="mt-3 text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                        <i class="fas fa-edit mr-1"></i> Update Address
                    </button>
                </div>
            </div>
        </div>

        <!-- Billing History -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-file-invoice mr-2 text-gray-600"></i>
                    Billing History
                </h2>
                <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                    View All
                </button>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse($invoices ?? [] as $invoice)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center">
                                <div class="bg-{{ $invoice->status === 'paid' ? 'green' : 'yellow' }}-100 rounded-full h-10 w-10 flex items-center justify-center mr-3">
                                    <i class="fas fa-{{ $invoice->status === 'paid' ? 'check' : 'clock' }} text-{{ $invoice->status === 'paid' ? 'green' : 'yellow' }}-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $invoice->description ?? 'Professional Plan - Monthly' }}</p>
                                    <p class="text-sm text-gray-500">{{ $invoice->date ?? 'Nov 15, 2025' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">${{ number_format($invoice->amount ?? 99, 2) }}</p>
                                <button class="text-xs text-indigo-600 hover:text-indigo-700 mt-1">
                                    <i class="fas fa-download mr-1"></i> Download
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No invoices yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Plan Features -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-list-check mr-2 text-gray-600"></i>
                Your Plan Features
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start">
                    <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Up to {{ $limits['users'] ?? 15 }} Team Members</p>
                        <p class="text-sm text-gray-500">Add realtors and staff to your agency</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Up to {{ $limits['properties'] ?? 500 }} Properties</p>
                        <p class="text-sm text-gray-500">List unlimited properties for sale or rent</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">CRM & Lead Management</p>
                        <p class="text-sm text-gray-500">Track leads through the sales pipeline</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Custom Website Builder</p>
                        <p class="text-sm text-gray-500">Build your agency website with themes</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">{{ $limits['storage'] ?? 10 }}GB Storage</p>
                        <p class="text-sm text-gray-500">Store property images and documents</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Email & Support</p>
                        <p class="text-sm text-gray-500">Priority customer support</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upgrade Options -->
    <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-lg p-6">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    <i class="fas fa-rocket mr-2 text-purple-600"></i>
                    Need More Features?
                </h3>
                <p class="text-gray-600 mb-4">
                    Upgrade to Enterprise plan for unlimited properties, custom branding, and dedicated support.
                </p>
                <button onclick="window.location.href='{{ route('agency.subscription.plans') }}'" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-medium">
                    View All Plans
                </button>
            </div>
            <i class="fas fa-crown text-yellow-500 text-4xl"></i>
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="bg-white rounded-lg shadow border-2 border-red-200">
        <div class="px-6 py-4 bg-red-50 border-b border-red-200">
            <h2 class="text-lg font-semibold text-red-900 flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Danger Zone
            </h2>
        </div>
        <div class="p-6">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="font-medium text-gray-900 mb-1">Cancel Subscription</h3>
                    <p class="text-sm text-gray-600">
                        Once you cancel, you'll lose access to all premium features at the end of your billing period.
                    </p>
                </div>
                <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium whitespace-nowrap">
                    Cancel Subscription
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
