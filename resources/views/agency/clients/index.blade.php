@extends('layouts.app')

@section('title', 'Clients Management')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-users mr-2 text-indigo-600"></i>
                Clients Management
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Manage all your agency clients and their portfolios
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-download mr-2"></i>
                Export
            </button>
            <button onclick="window.location.href='{{ route('agency.clients.create') }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add Client
            </button>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] ?? 84 }}</p>
            <p class="text-xs text-gray-600">Total Clients</p>
        </div>
        <div class="bg-green-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-green-900">{{ $stats['active'] ?? 76 }}</p>
            <p class="text-xs text-green-600">Active</p>
        </div>
        <div class="bg-blue-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-blue-900">{{ $stats['converted'] ?? 22 }}</p>
            <p class="text-xs text-blue-600">Converted This Month</p>
        </div>
        <div class="bg-purple-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-purple-900">{{ $stats['properties_owned'] ?? 128 }}</p>
            <p class="text-xs text-purple-600">Properties Owned</p>
        </div>
        <div class="bg-yellow-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-yellow-900">${{ number_format($stats['total_value'] ?? 24500000, 0) }}</p>
            <p class="text-xs text-yellow-600">Total Portfolio Value</p>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="md:col-span-2">
                <input type="text" placeholder="Search clients..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option>All Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option>All Types</option>
                    <option>Individual</option>
                    <option>Corporate</option>
                </select>
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option>All Realtors</option>
                    @foreach($realtors ?? [] as $realtor)
                        <option value="{{ $realtor->id }}">{{ $realtor->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Clients Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Assigned To</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Properties</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Value</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($clients ?? [] as $client)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-indigo-100 rounded-full h-10 w-10 flex items-center justify-center text-indigo-600 font-bold">
                                        {{ substr($client->name ?? 'C', 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $client->name ?? 'Client Name' }}</div>
                                        <div class="text-sm text-gray-500">
                                            @if($client->company_name ?? null)
                                                <i class="fas fa-building mr-1"></i>{{ $client->company_name }}
                                            @else
                                                ID: #{{ $client->id ?? '001' }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $client->email ?? 'client@example.com' }}</div>
                                <div class="text-sm text-gray-500">{{ $client->phone ?? '+1234567890' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ ($client->type ?? 'individual') === 'individual' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                    <i class="fas fa-{{ ($client->type ?? 'individual') === 'individual' ? 'user' : 'building' }} mr-1"></i>
                                    {{ ucfirst($client->type ?? 'individual') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($client->assigned_to ?? null)
                                    <div class="flex items-center">
                                        <img class="h-6 w-6 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($client->realtor_name ?? 'Realtor') }}" alt="">
                                        <span class="ml-2 text-sm text-gray-900">{{ $client->realtor_name ?? 'Realtor' }}</span>
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">Unassigned</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $client->properties_count ?? 0 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                ${{ number_format($client->portfolio_value ?? 0, 0) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ ($client->status ?? 'active') === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($client->status ?? 'active') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $client->created_at ?? 'Nov 15, 2025' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button onclick="window.location.href='{{ route('agency.clients.show', $client->id ?? 1) }}'" class="text-indigo-600 hover:text-indigo-900" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-blue-600 hover:text-blue-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-900" title="Add Property">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                    <button class="text-purple-600 hover:text-purple-900" title="Portal Access">
                                        <i class="fas fa-key"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-users text-gray-300 text-5xl mb-4"></i>
                                    <p class="text-gray-500 text-lg font-medium">No clients found</p>
                                    <p class="text-gray-400 text-sm mt-1">Start by adding your first client</p>
                                    <button onclick="window.location.href='{{ route('agency.clients.create') }}'" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md">
                                        <i class="fas fa-plus mr-2"></i>Add First Client
                                    </button>
                                </div>
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
                        Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">{{ $stats['total'] ?? 84 }}</span> results
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-indigo-50 text-sm font-medium text-indigo-600">1</a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
