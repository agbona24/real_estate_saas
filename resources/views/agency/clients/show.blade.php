@extends('layouts.app')

@section('title', 'Client Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-start">
        <div class="flex items-start space-x-4">
            <button onclick="window.history.back()" class="text-gray-600 hover:text-gray-900 mt-1">
                <i class="fas fa-arrow-left text-xl"></i>
            </button>
            <div class="flex items-start space-x-4">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($client->name ?? 'Client') }}&size=80" class="h-20 w-20 rounded-full border-4 border-white shadow-lg" alt="">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $client->name ?? 'John Doe' }}</h1>
                    <div class="flex items-center space-x-3 mt-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i> Active Client
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ ($client->type ?? 'individual') === 'individual' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                            {{ ucfirst($client->type ?? 'individual') }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">
                        Client since {{ $client->client_since ?? 'January 2025' }} •
                        ID: <span class="font-mono">{{ $client->reference ?? 'CLI-2025-001' }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md">
                <i class="fas fa-file-invoice mr-2"></i>
                Generate Report
            </button>
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md">
                <i class="fas fa-key mr-2"></i>
                Portal Access
            </button>
            <button onclick="window.location.href='{{ route('agency.clients.edit', $client->id ?? 1) }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                <i class="fas fa-edit mr-2"></i>
                Edit Client
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Portfolio Value</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($client->portfolio_value ?? 1200000, 0) }}</p>
                </div>
                <i class="fas fa-chart-line text-green-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Properties</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $client->properties_count ?? 3 }}</p>
                </div>
                <i class="fas fa-home text-indigo-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Transactions</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $client->transactions_count ?? 5 }}</p>
                </div>
                <i class="fas fa-handshake text-blue-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Documents</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $client->documents_count ?? 24 }}</p>
                </div>
                <i class="fas fa-folder text-yellow-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Pending Tasks</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $client->pending_tasks ?? 2 }}</p>
                </div>
                <i class="fas fa-tasks text-red-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-address-card mr-2 text-gray-600"></i>
                        Contact Information
                    </h2>
                    <button class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Email</label>
                            <p class="mt-1 text-sm text-gray-900 flex items-center">
                                <i class="fas fa-envelope text-gray-400 mr-2"></i>
                                {{ $client->email ?? 'john.doe@example.com' }}
                            </p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Phone</label>
                            <p class="mt-1 text-sm text-gray-900 flex items-center">
                                <i class="fas fa-phone text-gray-400 mr-2"></i>
                                {{ $client->phone ?? '+1 (555) 123-4567' }}
                            </p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Secondary Phone</label>
                            <p class="mt-1 text-sm text-gray-900 flex items-center">
                                <i class="fas fa-mobile-alt text-gray-400 mr-2"></i>
                                {{ $client->phone_secondary ?? '+1 (555) 987-6543' }}
                            </p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Address</label>
                            <p class="mt-1 text-sm text-gray-900 flex items-center">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                {{ $client->address ?? '123 Main St, Los Angeles, CA' }}
                            </p>
                        </div>
                        @if($client->company ?? null)
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase">Company</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $client->company }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-500 uppercase">Position</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $client->position ?? 'N/A' }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Assigned Realtor -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-user-tie mr-2 text-gray-600"></i>
                    Assigned Realtor
                </h2>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($client->realtor_name ?? 'Agent') }}" class="h-12 w-12 rounded-full" alt="">
                        <div>
                            <p class="font-medium text-gray-900">{{ $client->realtor_name ?? 'Sarah Johnson' }}</p>
                            <p class="text-sm text-gray-500">Senior Realtor</p>
                            <p class="text-xs text-gray-400 mt-1">
                                <i class="fas fa-phone mr-1"></i> {{ $client->realtor_phone ?? '+1 (555) 111-2222' }}
                            </p>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-3 py-1 rounded-md text-sm">
                            <i class="fas fa-phone"></i>
                        </button>
                        <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-3 py-1 rounded-md text-sm">
                            <i class="fas fa-envelope"></i>
                        </button>
                        <select class="px-3 py-1 border border-gray-300 rounded-md text-sm">
                            <option>Change Realtor</option>
                            @foreach($realtors ?? [] as $realtor)
                                <option value="{{ $realtor->id }}">{{ $realtor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Client Properties -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-home mr-2 text-gray-600"></i>
                        Properties Portfolio
                    </h2>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-plus mr-2"></i> Add Property
                    </button>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($client->properties ?? [] as $property)
                        <div class="p-4 hover:bg-gray-50">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $property->image ?? 'https://via.placeholder.com/100' }}" class="w-20 h-20 rounded object-cover" alt="">
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900">{{ $property->title ?? 'Luxury Villa' }}</h3>
                                    <p class="text-sm text-gray-500">{{ $property->address ?? 'Beverly Hills, CA' }}</p>
                                    <div class="flex items-center space-x-3 mt-1">
                                        <span class="text-sm font-bold text-indigo-600">${{ number_format($property->price ?? 450000, 0) }}</span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                            {{ ucfirst($property->status ?? 'owned') }}
                                        </span>
                                    </div>
                                </div>
                                <button onclick="window.location.href='{{ route('agency.properties.show', $property->id ?? 1) }}'" class="text-indigo-600 hover:text-indigo-700">
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <i class="fas fa-home text-gray-300 text-4xl mb-2"></i>
                            <p class="text-gray-500">No properties yet</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Transaction History -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-history mr-2 text-gray-600"></i>
                        Transaction History
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Property</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($client->transactions ?? [] as $transaction)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $transaction->date ?? 'Nov 15, 2025' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $transaction->property ?? '4 Bedroom Villa' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ ucfirst($transaction->type ?? 'purchase') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                        ${{ number_format($transaction->amount ?? 450000, 0) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                            {{ ucfirst($transaction->status ?? 'completed') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <button onclick="window.location.href='{{ route('agency.transactions.show', $transaction->id ?? 1) }}'" class="text-indigo-600 hover:text-indigo-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                        No transactions found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Activity Timeline -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-clock mr-2 text-gray-600"></i>
                        Recent Activity
                    </h2>
                    <button class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                        View All
                    </button>
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
                                                    {{ ($activity->type ?? 'note') === 'document' ? 'bg-blue-500' : '' }}
                                                    {{ ($activity->type ?? '') === 'transaction' ? 'bg-green-500' : '' }}
                                                    {{ ($activity->type ?? '') === 'property' ? 'bg-purple-500' : '' }}
                                                    {{ ($activity->type ?? '') === 'note' ? 'bg-gray-500' : '' }}">
                                                    <i class="fas fa-{{ ($activity->type ?? 'note') === 'document' ? 'file' : (($activity->type ?? '') === 'transaction' ? 'handshake' : (($activity->type ?? '') === 'property' ? 'home' : 'sticky-note')) }} text-white text-xs"></i>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">{{ $activity->description ?? 'Signed purchase agreement' }}</p>
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
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-envelope mr-2"></i> Send Email
                    </button>
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-phone mr-2"></i> Call Client
                    </button>
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-calendar mr-2"></i> Schedule Meeting
                    </button>
                    <button onclick="window.location.href='{{ route('agency.clients.documents', $client->id ?? 1) }}'" class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-folder mr-2"></i> View Documents
                    </button>
                </div>
            </div>

            <!-- Upcoming Tasks -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-900">Upcoming Tasks</h3>
                </div>
                <div class="p-4 space-y-3">
                    @foreach($upcoming_tasks ?? [] as $task)
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                            <p class="text-sm font-medium text-yellow-900">{{ $task->title ?? 'Review contract documents' }}</p>
                            <p class="text-xs text-yellow-700 mt-1">
                                <i class="fas fa-calendar mr-1"></i> {{ $task->date ?? 'Tomorrow' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Documents Summary -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-900">Documents</h3>
                    <span class="text-xs text-gray-500">{{ $client->documents_count ?? 24 }}</span>
                </div>
                <div class="p-4 space-y-2">
                    <div class="flex justify-between items-center py-2">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-file-contract text-blue-500"></i>
                            <span class="text-sm text-gray-700">Contracts</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900">{{ $docs['contracts'] ?? 8 }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-file-invoice text-green-500"></i>
                            <span class="text-sm text-gray-700">Receipts</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900">{{ $docs['receipts'] ?? 12 }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-certificate text-purple-500"></i>
                            <span class="text-sm text-gray-700">Title Docs</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900">{{ $docs['titles'] ?? 3 }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-file-alt text-gray-500"></i>
                            <span class="text-sm text-gray-700">Other</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900">{{ $docs['other'] ?? 1 }}</span>
                    </div>
                </div>
                <div class="px-6 py-3 border-t border-gray-200">
                    <button onclick="window.location.href='{{ route('agency.clients.documents', $client->id ?? 1) }}'" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                        View All Documents <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>

            <!-- Client Preferences -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Preferences</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Preferred Contact</span>
                        <span class="font-medium text-gray-900">{{ $client->preferred_contact ?? 'Email' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Language</span>
                        <span class="font-medium text-gray-900">{{ $client->language ?? 'English' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Time Zone</span>
                        <span class="font-medium text-gray-900">{{ $client->timezone ?? 'PST' }}</span>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Internal Notes</h3>
                <div class="space-y-3">
                    @foreach($notes ?? [] as $note)
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3">
                            <p class="text-xs text-gray-500 mb-1">{{ $note->date ?? '2 days ago' }}</p>
                            <p class="text-sm text-gray-700">{{ $note->content ?? 'High-value client. VIP treatment required.' }}</p>
                        </div>
                    @endforeach
                </div>
                <button class="mt-3 text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                    <i class="fas fa-plus mr-1"></i> Add Note
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
