@extends('layouts.app')

@section('title', 'Transaction Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-start">
        <div class="flex items-start space-x-4">
            <button onclick="window.history.back()" class="text-gray-600 hover:text-gray-900 mt-1">
                <i class="fas fa-arrow-left text-xl"></i>
            </button>
            <div>
                <div class="flex items-center space-x-3 mb-2">
                    <h1 class="text-3xl font-bold text-gray-900">Transaction {{ $transaction->reference ?? 'TXN-2025-001' }}</h1>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ ($transaction->status ?? 'pending') === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                        {{ ($transaction->status ?? '') === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ ($transaction->status ?? '') === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ ($transaction->status ?? '') === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                        <i class="fas fa-{{ ($transaction->status ?? 'pending') === 'completed' ? 'check-circle' : 'clock' }} mr-1"></i>
                        {{ ucfirst($transaction->status ?? 'pending') }}
                    </span>
                </div>
                <div class="flex items-center space-x-4 text-sm text-gray-600">
                    <span><i class="fas fa-calendar mr-1"></i> Created {{ $transaction->created_at ?? 'Nov 10, 2025' }}</span>
                    <span><i class="fas fa-clock mr-1"></i> Last updated {{ $transaction->updated_at ?? '2 hours ago' }}</span>
                </div>
            </div>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md">
                <i class="fas fa-print mr-2"></i>
                Print
            </button>
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md">
                <i class="fas fa-file-invoice-dollar mr-2"></i>
                Generate Invoice
            </button>
            <button onclick="window.location.href='{{ route('agency.transactions.edit', $transaction->id ?? 1) }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                <i class="fas fa-edit mr-2"></i>
                Edit
            </button>
        </div>
    </div>

    <!-- Transaction Value -->
    <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg shadow-lg p-6 text-white">
        <div class="grid grid-cols-4 gap-6">
            <div>
                <p class="text-sm opacity-90">Transaction Amount</p>
                <p class="text-4xl font-bold mt-1">${{ number_format($transaction->amount ?? 450000, 0) }}</p>
            </div>
            <div>
                <p class="text-sm opacity-90">Commission</p>
                <p class="text-3xl font-bold mt-1">${{ number_format($transaction->commission ?? 13500, 0) }}</p>
                <p class="text-xs opacity-75 mt-1">{{ $transaction->commission_rate ?? 3 }}% rate</p>
            </div>
            <div>
                <p class="text-sm opacity-90">Type</p>
                <p class="text-2xl font-bold mt-1">{{ ucfirst($transaction->type ?? 'sale') }}</p>
            </div>
            <div>
                <p class="text-sm opacity-90">Expected Completion</p>
                <p class="text-2xl font-bold mt-1">{{ $transaction->expected_completion ?? 'Dec 15, 2025' }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Progress Timeline -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-6">Transaction Progress</h2>
                <div class="relative">
                    <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                    @foreach(['Initiated', 'Documents Submitted', 'Under Review', 'Approved', 'Funds Released', 'Completed'] as $index => $stage)
                        <div class="relative flex items-start mb-6 last:mb-0">
                            <div class="flex items-center justify-center w-16 h-16 rounded-full ring-8 ring-white z-10
                                {{ $index <= ($transaction->current_stage ?? 2) ? 'bg-green-500' : 'bg-gray-300' }}">
                                @if($index < ($transaction->current_stage ?? 2))
                                    <i class="fas fa-check text-white text-xl"></i>
                                @elseif($index === ($transaction->current_stage ?? 2))
                                    <i class="fas fa-hourglass-half text-white text-xl"></i>
                                @else
                                    <i class="fas fa-circle text-white text-sm"></i>
                                @endif
                            </div>
                            <div class="ml-6 flex-1">
                                <h3 class="text-lg font-semibold {{ $index <= ($transaction->current_stage ?? 2) ? 'text-gray-900' : 'text-gray-500' }}">
                                    {{ $stage }}
                                </h3>
                                @if($index === ($transaction->current_stage ?? 2))
                                    <p class="text-sm text-green-600 font-medium">In Progress</p>
                                @elseif($index < ($transaction->current_stage ?? 2))
                                    <p class="text-sm text-gray-500">Completed {{ ['Nov 10', 'Nov 12', 'Nov 14'][$index] ?? 'Nov 10' }}, 2025</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Property Details -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-home mr-2 text-gray-600"></i>
                        Property Information
                    </h2>
                </div>
                <div class="p-6">
                    <div class="flex space-x-4">
                        <img src="{{ $transaction->property_image ?? 'https://via.placeholder.com/200' }}" class="w-32 h-32 rounded object-cover" alt="">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $transaction->property_title ?? '4 Bedroom Luxury Villa' }}</h3>
                            <p class="text-gray-600 mt-1">{{ $transaction->property_address ?? '123 Beverly Hills Rd, Beverly Hills, CA 90210' }}</p>
                            <div class="grid grid-cols-4 gap-4 mt-4 text-sm">
                                <div>
                                    <p class="text-gray-500">Bedrooms</p>
                                    <p class="font-medium text-gray-900">{{ $transaction->property_bedrooms ?? 4 }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Bathrooms</p>
                                    <p class="font-medium text-gray-900">{{ $transaction->property_bathrooms ?? 3 }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Size</p>
                                    <p class="font-medium text-gray-900">{{ number_format($transaction->property_size ?? 2500) }} sq ft</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Type</p>
                                    <p class="font-medium text-gray-900">{{ $transaction->property_type ?? 'House' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Information -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-user mr-2 text-gray-600"></i>
                        Client Information
                    </h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-6">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($transaction->client_name ?? 'Client') }}" class="h-16 w-16 rounded-full" alt="">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $transaction->client_name ?? 'John Doe' }}</h3>
                            <p class="text-sm text-gray-600">{{ $transaction->client_email ?? 'john@example.com' }}</p>
                            <p class="text-sm text-gray-600">{{ $transaction->client_phone ?? '+1 (555) 123-4567' }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500">Client ID</p>
                            <p class="font-medium text-gray-900">{{ $transaction->client_reference ?? 'CLI-2025-001' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Client Type</p>
                            <p class="font-medium text-gray-900">{{ ucfirst($transaction->client_type ?? 'individual') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Digital Document Room -->
            <div class="bg-white rounded-lg shadow" id="document-room">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-folder-open mr-2 text-gray-600"></i>
                        Digital Document Room
                    </h2>
                    <button onclick="document.getElementById('upload-modal').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-upload mr-2"></i>
                        Upload Document
                    </button>
                </div>

                <!-- Document Categories Tabs -->
                <div class="border-b border-gray-200" x-data="{ tab: 'all' }">
                    <nav class="flex -mb-px px-6" >
                        <button @click="tab = 'all'" :class="tab === 'all' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm">
                            All Documents ({{ $documents_count ?? 12 }})
                        </button>
                        <button @click="tab = 'offers'" :class="tab === 'offers' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm">
                            Offer Letters ({{ $docs['offers'] ?? 2 }})
                        </button>
                        <button @click="tab = 'contracts'" :class="tab === 'contracts' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm">
                            Contracts ({{ $docs['contracts'] ?? 3 }})
                        </button>
                        <button @click="tab = 'allocation'" :class="tab === 'allocation' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm">
                            Allocation ({{ $docs['allocation'] ?? 1 }})
                        </button>
                        <button @click="tab = 'receipts'" :class="tab === 'receipts' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm">
                            Receipts ({{ $docs['receipts'] ?? 4 }})
                        </button>
                        <button @click="tab = 'titles'" :class="tab === 'titles' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm">
                            Title Docs ({{ $docs['titles'] ?? 2 }})
                        </button>
                    </nav>
                </div>

                <!-- Documents List -->
                <div class="divide-y divide-gray-200">
                    @forelse($documents ?? [] as $document)
                        <div class="p-4 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4 flex-1">
                                    <!-- File Icon -->
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 rounded-lg flex items-center justify-center
                                            {{ ($document->type ?? 'pdf') === 'pdf' ? 'bg-red-100' : 'bg-blue-100' }}">
                                            <i class="fas fa-file-{{ ($document->type ?? 'pdf') === 'pdf' ? 'pdf' : 'word' }} text-2xl
                                                {{ ($document->type ?? 'pdf') === 'pdf' ? 'text-red-600' : 'text-blue-600' }}"></i>
                                        </div>
                                    </div>

                                    <!-- Document Info -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center space-x-2">
                                            <h3 class="text-sm font-medium text-gray-900 truncate">{{ $document->name ?? 'Purchase Agreement.pdf' }}</h3>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ ucfirst($document->category ?? 'contract') }}
                                            </span>
                                            @if($document->requires_signature ?? true)
                                                @if($document->signed ?? false)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-check-circle mr-1"></i> Signed
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <i class="fas fa-pen mr-1"></i> Awaiting Signature
                                                    </span>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="flex items-center space-x-4 mt-1 text-xs text-gray-500">
                                            <span><i class="fas fa-user mr-1"></i> Uploaded by {{ $document->uploaded_by ?? 'Sarah Johnson' }}</span>
                                            <span><i class="fas fa-calendar mr-1"></i> {{ $document->uploaded_at ?? 'Nov 15, 2025' }}</span>
                                            <span><i class="fas fa-file mr-1"></i> {{ $document->size ?? '2.4 MB' }}</span>
                                            @if($document->signed_at ?? null)
                                                <span class="text-green-600"><i class="fas fa-signature mr-1"></i> Signed {{ $document->signed_at }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex items-center space-x-2 ml-4">
                                    <button class="text-indigo-600 hover:text-indigo-700 px-3 py-1 text-sm" title="Preview">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-blue-600 hover:text-blue-700 px-3 py-1 text-sm" title="Download">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    @if(!($document->signed ?? false) && ($document->requires_signature ?? true))
                                        <button onclick="window.location.href='{{ route('documents.sign', $document->id ?? 1) }}'" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                                            <i class="fas fa-pen mr-1"></i> Sign
                                        </button>
                                    @endif
                                    <button class="text-gray-600 hover:text-gray-700 px-3 py-1 text-sm" title="More">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Signature History (if signed) -->
                            @if($document->signatures ?? null)
                                <div class="mt-3 ml-16 p-3 bg-green-50 rounded-lg">
                                    <p class="text-xs font-medium text-green-900 mb-2"><i class="fas fa-signature mr-1"></i> Signature History</p>
                                    @foreach($document->signatures as $signature)
                                        <div class="flex items-center justify-between text-xs text-green-700 mb-1 last:mb-0">
                                            <span>{{ $signature->signer ?? 'John Doe' }} ({{ $signature->role ?? 'Client' }})</span>
                                            <span>{{ $signature->signed_at ?? 'Nov 15, 2025 2:30 PM' }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <i class="fas fa-folder-open text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500 text-lg font-medium">No documents yet</p>
                            <p class="text-gray-400 text-sm mt-1">Upload your first document to get started</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Activity Log -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-history mr-2 text-gray-600"></i>
                        Activity Log
                    </h2>
                </div>
                <div class="p-6">
                    <div class="flow-root">
                        <ul class="-mb-8">
                            @foreach($activities ?? [] as $activity)
                                <li>
                                    <div class="relative pb-8">
                                        @if(!$loop->last)
                                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"></span>
                                        @endif
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white
                                                    {{ ($activity->type ?? 'update') === 'created' ? 'bg-green-500' : '' }}
                                                    {{ ($activity->type ?? '') === 'document' ? 'bg-blue-500' : '' }}
                                                    {{ ($activity->type ?? '') === 'signature' ? 'bg-purple-500' : '' }}
                                                    {{ ($activity->type ?? '') === 'update' ? 'bg-yellow-500' : '' }}">
                                                    <i class="fas fa-{{ ($activity->type ?? 'update') === 'created' ? 'plus' : (($activity->type ?? '') === 'document' ? 'file' : (($activity->type ?? '') === 'signature' ? 'pen' : 'edit')) }} text-white text-xs"></i>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">
                                                        <span class="font-medium text-gray-900">{{ $activity->user ?? 'Sarah Johnson' }}</span>
                                                        {{ $activity->action ?? 'updated transaction status' }}
                                                    </p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    {{ $activity->time ?? '2 hours ago' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- Assigned Realtor -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Assigned Realtor</h3>
                <div class="flex items-center space-x-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($transaction->realtor_name ?? 'Agent') }}" class="h-12 w-12 rounded-full" alt="">
                    <div>
                        <p class="font-medium text-gray-900">{{ $transaction->realtor_name ?? 'Sarah Johnson' }}</p>
                        <p class="text-sm text-gray-500">Senior Realtor</p>
                    </div>
                </div>
                <div class="mt-4 space-y-2">
                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-phone mr-2"></i> Call
                    </button>
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-envelope mr-2"></i> Email
                    </button>
                </div>
            </div>

            <!-- Commission Breakdown -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Commission Breakdown</h3>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Total Commission</span>
                        <span class="font-bold text-gray-900">${{ number_format($transaction->commission ?? 13500, 0) }}</span>
                    </div>
                    <div class="h-px bg-gray-200"></div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Agency Share (70%)</span>
                        <span class="font-medium text-gray-900">${{ number_format(($transaction->commission ?? 13500) * 0.7, 0) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Realtor Share (30%)</span>
                        <span class="font-medium text-gray-900">${{ number_format(($transaction->commission ?? 13500) * 0.3, 0) }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Status -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Payment Status</h3>
                <div class="space-y-3">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-medium text-green-900">Deposit Paid</span>
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded">Received</span>
                        </div>
                        <p class="text-lg font-bold text-green-900">${{ number_format($transaction->deposit ?? 45000, 0) }}</p>
                        <p class="text-xs text-green-700 mt-1">{{ $transaction->deposit_date ?? 'Nov 10, 2025' }}</p>
                    </div>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-medium text-yellow-900">Balance Due</span>
                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded">Pending</span>
                        </div>
                        <p class="text-lg font-bold text-yellow-900">${{ number_format(($transaction->amount ?? 450000) - ($transaction->deposit ?? 45000), 0) }}</p>
                        <p class="text-xs text-yellow-700 mt-1">Due: {{ $transaction->balance_due_date ?? 'Dec 15, 2025' }}</p>
                    </div>
                </div>
            </div>

            <!-- Next Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Next Actions</h3>
                <div class="space-y-3">
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3">
                        <p class="text-sm font-medium text-yellow-900">Pending Document</p>
                        <p class="text-xs text-yellow-700 mt-1">Client needs to sign purchase agreement</p>
                        <button class="mt-2 text-xs text-yellow-800 hover:text-yellow-900 font-medium">
                            Send Reminder <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-3">
                        <p class="text-sm font-medium text-blue-900">Upcoming Inspection</p>
                        <p class="text-xs text-blue-700 mt-1">Scheduled for Nov 20, 2025</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm text-left">
                        <i class="fas fa-file-invoice-dollar mr-2 text-green-500"></i> Generate Invoice
                    </button>
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm text-left">
                        <i class="fas fa-envelope mr-2 text-blue-500"></i> Email Client
                    </button>
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm text-left">
                        <i class="fas fa-calendar mr-2 text-purple-500"></i> Schedule Meeting
                    </button>
                    <button class="w-full bg-white border border-red-300 hover:bg-red-50 text-red-700 px-4 py-2 rounded-md text-sm text-left">
                        <i class="fas fa-times-circle mr-2"></i> Cancel Transaction
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal (Hidden by default) -->
<div id="upload-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Upload Document</h3>
            <button onclick="document.getElementById('upload-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Document Category</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option value="offer">Offer Letter</option>
                    <option value="contract">Contract of Sale</option>
                    <option value="allocation">Allocation Letter</option>
                    <option value="receipt">Receipt</option>
                    <option value="title">Title Document</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Document Name</label>
                <input type="text" placeholder="e.g., Purchase Agreement" class="w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">File</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-500 cursor-pointer">
                    <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                    <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX up to 10MB</p>
                </div>
            </div>
            <div class="flex items-center">
                <input type="checkbox" id="requires-signature" class="h-4 w-4 text-indigo-600 rounded">
                <label for="requires-signature" class="ml-2 text-sm text-gray-700">This document requires e-signature</label>
            </div>
            <div class="flex space-x-3 pt-4">
                <button type="button" onclick="document.getElementById('upload-modal').classList.add('hidden')" class="flex-1 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md">
                    Cancel
                </button>
                <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
