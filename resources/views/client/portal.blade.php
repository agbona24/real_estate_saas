@extends('layouts.app')

@section('title', 'My Portal')

@section('content')
<div class="space-y-6">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Welcome back, {{ auth()->user()->name ?? 'John Doe' }}!</h1>
                <p class="mt-2 text-indigo-100">Track your property purchase journey and stay updated</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-indigo-100">Client ID</p>
                <p class="text-2xl font-bold">{{ $client->reference ?? 'CLI-2025-001' }}</p>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Active Deals</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['active_deals'] ?? 2 }}</p>
                </div>
                <i class="fas fa-handshake text-indigo-500 text-3xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Properties</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['properties'] ?? 3 }}</p>
                </div>
                <i class="fas fa-home text-green-500 text-3xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Documents</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['documents'] ?? 24 }}</p>
                </div>
                <i class="fas fa-folder text-yellow-500 text-3xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Messages</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['unread_messages'] ?? 3 }}</p>
                </div>
                <i class="fas fa-envelope text-blue-500 text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Purchase Progress -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-tasks mr-2 text-indigo-600"></i>
                        Purchase Progress
                    </h2>
                    <select class="px-3 py-1 border border-gray-300 rounded-md text-sm">
                        @foreach($transactions ?? [] as $transaction)
                            <option value="{{ $transaction->id }}">{{ $transaction->property_title ?? '4 Bedroom Villa' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="p-6">
                    <!-- Progress Bar -->
                    <div class="mb-6">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="font-medium text-gray-700">Overall Progress</span>
                            <span class="font-medium text-indigo-600">{{ $progress ?? 60 }}% Complete</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 h-3 rounded-full transition-all duration-500" style="width: {{ $progress ?? 60 }}%"></div>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="relative">
                        <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                        @foreach([
                            ['title' => 'Offer Accepted', 'status' => 'completed', 'date' => 'Nov 1, 2025', 'description' => 'Your offer was accepted by the seller'],
                            ['title' => 'Documents Submitted', 'status' => 'completed', 'date' => 'Nov 5, 2025', 'description' => 'All required documents have been submitted'],
                            ['title' => 'Verification In Progress', 'status' => 'current', 'date' => 'In Progress', 'description' => 'Documents are being verified (3/5 completed)'],
                            ['title' => 'Payment Processing', 'status' => 'pending', 'date' => 'Pending', 'description' => 'Final payment and funds transfer'],
                            ['title' => 'Title Transfer', 'status' => 'pending', 'date' => 'Pending', 'description' => 'Property ownership transfer'],
                            ['title' => 'Completion', 'status' => 'pending', 'date' => 'Expected: Dec 15, 2025', 'description' => 'Keys handover and final completion']
                        ] as $index => $stage)
                            <div class="relative flex items-start mb-8 last:mb-0">
                                <div class="flex items-center justify-center w-16 h-16 rounded-full ring-8 ring-white z-10
                                    {{ $stage['status'] === 'completed' ? 'bg-green-500' : '' }}
                                    {{ $stage['status'] === 'current' ? 'bg-indigo-500' : '' }}
                                    {{ $stage['status'] === 'pending' ? 'bg-gray-300' : '' }}">
                                    @if($stage['status'] === 'completed')
                                        <i class="fas fa-check text-white text-xl"></i>
                                    @elseif($stage['status'] === 'current')
                                        <i class="fas fa-hourglass-half text-white text-xl"></i>
                                    @else
                                        <i class="fas fa-circle text-white text-sm"></i>
                                    @endif
                                </div>
                                <div class="ml-6 flex-1">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold {{ $stage['status'] === 'pending' ? 'text-gray-500' : 'text-gray-900' }}">
                                                {{ $stage['title'] }}
                                            </h3>
                                            <p class="text-sm {{ $stage['status'] === 'current' ? 'text-indigo-600 font-medium' : 'text-gray-500' }}">
                                                {{ $stage['date'] }}
                                            </p>
                                            <p class="text-sm text-gray-600 mt-1">{{ $stage['description'] }}</p>
                                        </div>
                                        @if($stage['status'] === 'completed')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Done
                                            </span>
                                        @elseif($stage['status'] === 'current')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">
                                                <i class="fas fa-spinner mr-1"></i> Active
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Payment Schedule -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-calendar-alt mr-2 text-green-600"></i>
                        Payment Schedule
                    </h2>
                    <span class="text-sm text-gray-600">Property: {{ $property->title ?? '4 Bedroom Villa' }}</span>
                </div>
                <div class="p-6">
                    <!-- Total Summary -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg p-4 mb-6">
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div>
                                <p class="text-sm text-gray-600">Total Price</p>
                                <p class="text-2xl font-bold text-gray-900">${{ number_format($payment->total ?? 450000, 0) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Paid</p>
                                <p class="text-2xl font-bold text-green-600">${{ number_format($payment->paid ?? 45000, 0) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Balance</p>
                                <p class="text-2xl font-bold text-orange-600">${{ number_format(($payment->total ?? 450000) - ($payment->paid ?? 45000), 0) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Items -->
                    <div class="space-y-3">
                        @foreach($payment_schedule ?? [] as $payment_item)
                            <div class="border border-gray-200 rounded-lg p-4 {{ ($payment_item->status ?? 'pending') === 'paid' ? 'bg-green-50 border-green-300' : '' }}">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-start space-x-3">
                                        <div class="mt-1">
                                            @if(($payment_item->status ?? 'pending') === 'paid')
                                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                                            @elseif(($payment_item->status ?? '') === 'due')
                                                <i class="fas fa-exclamation-circle text-yellow-600 text-xl"></i>
                                            @else
                                                <i class="fas fa-circle text-gray-400 text-xl"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900">{{ $payment_item->title ?? 'Initial Deposit' }}</h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ $payment_item->description ?? '10% of purchase price' }}</p>
                                            <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                                <span><i class="fas fa-calendar mr-1"></i> Due: {{ $payment_item->due_date ?? 'Nov 5, 2025' }}</span>
                                                @if($payment_item->paid_date ?? null)
                                                    <span class="text-green-600"><i class="fas fa-check mr-1"></i> Paid: {{ $payment_item->paid_date }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xl font-bold {{ ($payment_item->status ?? 'pending') === 'paid' ? 'text-green-600' : 'text-gray-900' }}">
                                            ${{ number_format($payment_item->amount ?? 45000, 0) }}
                                        </p>
                                        @if(($payment_item->status ?? 'pending') === 'paid')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 mt-1">
                                                Paid
                                            </span>
                                        @elseif(($payment_item->status ?? '') === 'due')
                                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs font-medium mt-1">
                                                Pay Now
                                            </button>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 mt-1">
                                                Pending
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Download Receipt -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md">
                            <i class="fas fa-download mr-2"></i> Download Payment History
                        </button>
                    </div>
                </div>
            </div>

            <!-- Verification Status -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-shield-alt mr-2 text-blue-600"></i>
                        Verification Status
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach([
                            ['title' => 'Identity Verification', 'status' => 'verified', 'description' => 'Government ID verified'],
                            ['title' => 'Income Verification', 'status' => 'verified', 'description' => 'Employment and income documents approved'],
                            ['title' => 'Credit Check', 'status' => 'in_progress', 'description' => 'Credit score assessment underway'],
                            ['title' => 'Property Inspection', 'status' => 'pending', 'description' => 'Scheduled for Nov 20, 2025'],
                            ['title' => 'Legal Review', 'status' => 'pending', 'description' => 'Contract and title review']
                        ] as $verification)
                            <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 mt-1">
                                    @if($verification['status'] === 'verified')
                                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <i class="fas fa-check text-green-600"></i>
                                        </div>
                                    @elseif($verification['status'] === 'in_progress')
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-spinner text-blue-600"></i>
                                        </div>
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-clock text-gray-500"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="font-medium text-gray-900">{{ $verification['title'] }}</h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ $verification['description'] }}</p>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $verification['status'] === 'verified' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $verification['status'] === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $verification['status'] === 'pending' ? 'bg-gray-100 text-gray-800' : '' }}">
                                            {{ ucfirst(str_replace('_', ' ', $verification['status'])) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Recent Documents -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-folder-open mr-2 text-yellow-600"></i>
                        Recent Documents
                    </h2>
                    <button onclick="window.location.href='{{ route('client.documents.index') }}'" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($recent_documents ?? [] as $document)
                        <div class="px-6 py-4 hover:bg-gray-50 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-file-pdf text-red-600 text-2xl"></i>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $document->name ?? 'Purchase Agreement.pdf' }}</p>
                                    <p class="text-xs text-gray-500">Uploaded {{ $document->uploaded_at ?? '2 days ago' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="text-indigo-600 hover:text-indigo-700 px-2 py-1">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-blue-600 hover:text-blue-700 px-2 py-1">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- Assigned Realtor -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-user-tie mr-2 text-indigo-600"></i>
                    Your Realtor
                </h3>
                <div class="text-center mb-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($realtor->name ?? 'Agent') }}&size=100" class="h-24 w-24 rounded-full mx-auto border-4 border-indigo-100" alt="">
                    <h4 class="mt-3 font-semibold text-gray-900">{{ $realtor->name ?? 'Sarah Johnson' }}</h4>
                    <p class="text-sm text-gray-600">Senior Real Estate Agent</p>
                    <div class="flex items-center justify-center space-x-2 mt-2">
                        <div class="flex items-center">
                            @for($i = 0; $i < 5; $i++)
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                            @endfor
                        </div>
                        <span class="text-xs text-gray-600">(4.9/5)</span>
                    </div>
                </div>
                <div class="space-y-2 mb-4">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-phone w-5 mr-2 text-gray-400"></i>
                        <span>{{ $realtor->phone ?? '+1 (555) 123-4567' }}</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-envelope w-5 mr-2 text-gray-400"></i>
                        <span>{{ $realtor->email ?? 'sarah@agency.com' }}</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-map-marker-alt w-5 mr-2 text-gray-400"></i>
                        <span>{{ $realtor->office ?? 'Beverly Hills Office' }}</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <button onclick="window.location.href='{{ route('client.chat', $realtor->id ?? 1) }}'" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-comment mr-2"></i> Send Message
                    </button>
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md">
                        <i class="fas fa-phone mr-2"></i> Call Now
                    </button>
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md">
                        <i class="fas fa-calendar mr-2"></i> Schedule Meeting
                    </button>
                </div>
            </div>

            <!-- Quick Chat -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-900">Recent Messages</h3>
                    <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $stats['unread_messages'] ?? 3 }}</span>
                </div>
                <div class="p-4 max-h-96 overflow-y-auto">
                    @foreach($recent_messages ?? [] as $message)
                        <div class="mb-4 last:mb-0">
                            <div class="flex items-start space-x-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($message->sender ?? 'Sender') }}" class="h-8 w-8 rounded-full" alt="">
                                <div class="flex-1 bg-gray-100 rounded-lg p-3">
                                    <div class="flex items-center justify-between mb-1">
                                        <p class="text-xs font-medium text-gray-900">{{ $message->sender ?? 'Sarah Johnson' }}</p>
                                        <p class="text-xs text-gray-500">{{ $message->time ?? '2h ago' }}</p>
                                    </div>
                                    <p class="text-sm text-gray-700">{{ $message->content ?? 'Hi! The property inspection has been scheduled for Nov 20th. Please confirm your availability.' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="px-6 py-3 border-t border-gray-200">
                    <button onclick="window.location.href='{{ route('client.chat') }}'" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                        View All Messages <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>

            <!-- Action Items -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Action Required</h3>
                <div class="space-y-3">
                    @foreach($action_items ?? [] as $action)
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                            <p class="text-sm font-medium text-yellow-900">{{ $action->title ?? 'Sign Purchase Agreement' }}</p>
                            <p class="text-xs text-yellow-700 mt-1">Due: {{ $action->due ?? 'Tomorrow' }}</p>
                            <button class="mt-2 text-xs text-yellow-800 hover:text-yellow-900 font-medium">
                                Take Action <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Support -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Need Help?</h3>
                <div class="space-y-3">
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm text-left">
                        <i class="fas fa-question-circle mr-2 text-blue-500"></i> FAQ
                    </button>
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm text-left">
                        <i class="fas fa-headset mr-2 text-green-500"></i> Contact Support
                    </button>
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm text-left">
                        <i class="fas fa-book mr-2 text-purple-500"></i> User Guide
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
