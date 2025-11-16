@extends('layouts.app')

@section('title', 'Transactions & Deals')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-handshake mr-2 text-indigo-600"></i>
                Transactions & Deals
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Track all property transactions and manage deals
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-download mr-2"></i>
                Export Report
            </button>
            <button onclick="window.location.href='{{ route('tenant.transactions.create') }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i>
                New Transaction
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] ?? 156 }}</p>
            <p class="text-xs text-gray-600">Total Transactions</p>
        </div>
        <div class="bg-green-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-green-900">{{ $stats['completed'] ?? 89 }}</p>
            <p class="text-xs text-green-600">Completed</p>
        </div>
        <div class="bg-blue-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-blue-900">{{ $stats['in_progress'] ?? 32 }}</p>
            <p class="text-xs text-blue-600">In Progress</p>
        </div>
        <div class="bg-yellow-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-yellow-900">{{ $stats['pending'] ?? 24 }}</p>
            <p class="text-xs text-yellow-600">Pending</p>
        </div>
        <div class="bg-purple-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-purple-900">${{ number_format($stats['total_value'] ?? 12500000, 0) }}</p>
            <p class="text-xs text-purple-600">Total Value</p>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-lg shadow">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px space-x-8 px-6" x-data="{ tab: 'all' }">
                <button @click="tab = 'all'" :class="tab === 'all' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    All Transactions
                </button>
                <button @click="tab = 'sale'" :class="tab === 'sale' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Sales
                </button>
                <button @click="tab = 'rent'" :class="tab === 'rent' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Rentals
                </button>
                <button @click="tab = 'lease'" :class="tab === 'lease' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Leases
                </button>
                <button @click="tab = 'completed'" :class="tab === 'completed' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    <i class="fas fa-check-circle mr-1"></i> Completed
                </button>
            </nav>
        </div>

        <!-- Search and Filters -->
        <div class="p-4 border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <input type="text" placeholder="Search transactions by property, client, or reference..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option>All Realtors</option>
                        @foreach($realtors ?? [] as $realtor)
                            <option value="{{ $realtor->id }}">{{ $realtor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option>All Time</option>
                        <option>This Month</option>
                        <option>Last Month</option>
                        <option>This Quarter</option>
                        <option>This Year</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Property</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Realtor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commission</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($transactions ?? [] as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-mono font-medium text-gray-900">{{ $transaction->reference ?? 'TXN-2025-001' }}</div>
                                <div class="text-xs text-gray-500">{{ $transaction->created_at ?? 'Nov 15, 2025' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <img class="h-10 w-10 rounded object-cover" src="{{ $transaction->property_image ?? 'https://via.placeholder.com/100' }}" alt="">
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $transaction->property_title ?? '4 Bedroom Villa' }}</div>
                                        <div class="text-xs text-gray-500">{{ $transaction->property_location ?? 'Beverly Hills, CA' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $transaction->client_name ?? 'John Doe' }}</div>
                                <div class="text-xs text-gray-500">{{ $transaction->client_email ?? 'john@example.com' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-6 w-6 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($transaction->realtor_name ?? 'Agent') }}" alt="">
                                    <span class="ml-2 text-sm text-gray-900">{{ $transaction->realtor_name ?? 'Sarah Johnson' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ ($transaction->type ?? 'sale') === 'sale' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ ($transaction->type ?? '') === 'rent' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ ($transaction->type ?? '') === 'lease' ? 'bg-purple-100 text-purple-800' : '' }}">
                                    {{ ucfirst($transaction->type ?? 'sale') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                ${{ number_format($transaction->amount ?? 450000, 0) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-green-600">${{ number_format($transaction->commission ?? 13500, 0) }}</div>
                                <div class="text-xs text-gray-500">{{ $transaction->commission_rate ?? 3 }}%</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ ($transaction->status ?? 'pending') === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ ($transaction->status ?? '') === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ ($transaction->status ?? '') === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ ($transaction->status ?? '') === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    <i class="fas fa-{{ ($transaction->status ?? 'pending') === 'completed' ? 'check-circle' : 'clock' }} mr-1"></i>
                                    {{ ucfirst($transaction->status ?? 'pending') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $transaction->completion_date ?? 'Nov 15, 2025' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button onclick="window.location.href='{{ route('tenant.transactions.show', $transaction->id ?? 1) }}'" class="text-indigo-600 hover:text-indigo-900" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-blue-600 hover:text-blue-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-900" title="Generate Invoice">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </button>
                                    <button class="text-purple-600 hover:text-purple-900" title="Documents">
                                        <i class="fas fa-folder"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-12 text-center">
                                <i class="fas fa-handshake text-gray-300 text-5xl mb-4"></i>
                                <p class="text-gray-500 text-lg font-medium">No transactions found</p>
                                <p class="text-gray-400 text-sm mt-1">Start by creating your first transaction</p>
                                <button onclick="window.location.href='{{ route('tenant.transactions.create') }}'" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md">
                                    <i class="fas fa-plus mr-2"></i>Create Transaction
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200">
            <div class="flex-1 flex justify-between sm:hidden">
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</a>
                <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</a>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">15</span> of <span class="font-medium">{{ $stats['total'] ?? 156 }}</span> results
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-indigo-50 text-sm font-medium text-indigo-600">1</a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Timeline -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-clock mr-2 text-gray-600"></i>
                Recent Activity
            </h2>
        </div>
        <div class="p-6">
            <div class="flow-root">
                <ul class="-mb-8">
                    @foreach($recentActivity ?? [] as $index => $activity)
                        <li>
                            <div class="relative pb-8">
                                @if(!$loop->last)
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"></span>
                                @endif
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white
                                            {{ ($activity->type ?? 'update') === 'created' ? 'bg-green-500' : '' }}
                                            {{ ($activity->type ?? '') === 'updated' ? 'bg-blue-500' : '' }}
                                            {{ ($activity->type ?? '') === 'completed' ? 'bg-purple-500' : '' }}">
                                            <i class="fas fa-{{ ($activity->type ?? 'update') === 'created' ? 'plus' : (($activity->type ?? '') === 'completed' ? 'check' : 'edit') }} text-white text-xs"></i>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">
                                                <span class="font-medium text-gray-900">{{ $activity->user ?? 'Sarah Johnson' }}</span>
                                                {{ $activity->action ?? 'updated transaction' }}
                                                <span class="font-medium text-gray-900">{{ $activity->reference ?? 'TXN-2025-001' }}</span>
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
@endsection
