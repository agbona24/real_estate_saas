@extends('layouts.app')

@section('title', 'Client Portal')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg shadow-xl p-8 text-white">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">
                    <i class="fas fa-home mr-2"></i>
                    Welcome, {{ auth()->user()->name }}!
                </h1>
                <p class="mt-2 text-indigo-100">
                    Your property portfolio and account overview
                </p>
            </div>
            <div>
                <button class="bg-white text-indigo-600 hover:bg-indigo-50 px-6 py-3 rounded-lg font-semibold shadow-lg flex items-center">
                    <i class="fas fa-headset mr-2"></i>
                    Contact Support
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- My Properties -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">My Properties</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['my_properties'] ?? 3 }}</p>
                    <p class="text-sm text-indigo-600 mt-1">
                        <i class="fas fa-eye"></i> View all properties
                    </p>
                </div>
                <div class="bg-indigo-100 rounded-full p-4">
                    <i class="fas fa-home text-indigo-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Investment -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Investment</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">${{ number_format($stats['total_investment'] ?? 875000, 0) }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up"></i> 12% appreciation
                    </p>
                </div>
                <div class="bg-green-100 rounded-full p-4">
                    <i class="fas fa-dollar-sign text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Pending Payments -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending Payments</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">${{ number_format($stats['pending_payments'] ?? 15000, 0) }}</p>
                    <p class="text-sm text-yellow-600 mt-1">
                        <i class="fas fa-clock"></i> Due in 15 days
                    </p>
                </div>
                <div class="bg-yellow-100 rounded-full p-4">
                    <i class="fas fa-credit-card text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- My Properties -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-home mr-2 text-gray-600"></i>
                My Properties
            </h2>
            <a href="{{ route('client.properties') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($myProperties ?? [] as $property)
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
                        <div class="relative">
                            <img src="{{ $property->image ?? 'https://via.placeholder.com/400x250' }}" alt="{{ $property->title ?? 'Property' }}" class="w-full h-48 object-cover">
                            <span class="absolute top-2 right-2 bg-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                Owned
                            </span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 text-lg">{{ $property->title ?? 'Luxury Villa' }}</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                {{ $property->location ?? 'Beverly Hills, CA' }}
                            </p>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-lg font-bold text-indigo-600">${{ number_format($property->price ?? 450000, 0) }}</span>
                                <span class="text-sm text-gray-500">Purchased {{ $property->purchased_at ?? '2023-06-15' }}</span>
                            </div>
                            <div class="mt-4 grid grid-cols-3 gap-2 text-center text-sm">
                                <div class="bg-gray-50 rounded p-2">
                                    <i class="fas fa-bed text-gray-600"></i>
                                    <p class="font-medium text-gray-900 mt-1">{{ $property->bedrooms ?? 4 }}</p>
                                </div>
                                <div class="bg-gray-50 rounded p-2">
                                    <i class="fas fa-bath text-gray-600"></i>
                                    <p class="font-medium text-gray-900 mt-1">{{ $property->bathrooms ?? 3 }}</p>
                                </div>
                                <div class="bg-gray-50 rounded p-2">
                                    <i class="fas fa-ruler-combined text-gray-600"></i>
                                    <p class="font-medium text-gray-900 mt-1">{{ $property->area ?? '2500' }} sqft</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('client.properties.show', $property->id ?? 1) }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <i class="fas fa-home text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500">No properties found</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Payment History & Documents -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Payments -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-credit-card mr-2 text-gray-600"></i>
                    Recent Payments
                </h2>
                <a href="{{ route('client.payments') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse($recentPayments ?? [] as $payment)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="bg-{{ $payment->status_color ?? 'green' }}-100 rounded-full h-10 w-10 flex items-center justify-center">
                                    <i class="fas fa-{{ $payment->status === 'completed' ? 'check' : 'clock' }} text-{{ $payment->status_color ?? 'green' }}-600"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">{{ $payment->description ?? 'Property Payment' }}</p>
                                    <p class="text-sm text-gray-500">{{ $payment->date ?? 'Nov 15, 2025' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">${{ number_format($payment->amount ?? 5000, 0) }}</p>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-{{ $payment->status_color ?? 'green' }}-100 text-{{ $payment->status_color ?? 'green' }}-800">
                                    {{ ucfirst($payment->status ?? 'completed') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No payment history</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- My Documents -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-file-alt mr-2 text-gray-600"></i>
                    My Documents
                </h2>
                <a href="{{ route('client.documents') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse($myDocuments ?? [] as $document)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition cursor-pointer">
                            <div class="flex items-center">
                                <div class="bg-blue-100 rounded-lg h-10 w-10 flex items-center justify-center">
                                    <i class="fas fa-file-{{ $document->type === 'pdf' ? 'pdf' : 'alt' }} text-blue-600"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">{{ $document->name ?? 'Property Deed.pdf' }}</p>
                                    <p class="text-sm text-gray-500">{{ $document->size ?? '2.4 MB' }} • {{ $document->property ?? 'Luxury Villa' }}</p>
                                </div>
                            </div>
                            <button class="text-indigo-600 hover:text-indigo-700">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No documents available</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Actions -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-exclamation-circle mr-2 text-gray-600"></i>
                Action Required
            </h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($pendingActions ?? [] as $action)
                    <div class="flex items-start p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded-lg">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="font-medium text-gray-900">{{ $action->title ?? 'Contract Signature Required' }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ $action->description ?? 'Please review and sign the contract for Luxury Villa' }}</p>
                            <button class="mt-3 bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Take Action
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-check-circle text-green-400 text-5xl mb-3"></i>
                        <p class="text-gray-500">All caught up! No pending actions.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
