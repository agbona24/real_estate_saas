@extends('layouts.app')

@section('title', 'Team Management')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-user-tie mr-2 text-indigo-600"></i>
                Team Management
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Manage your agency's realtors and team members
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-download mr-2"></i>
                Export
            </button>
            <button onclick="window.location.href='{{ route('agency.realtors.create') }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add Realtor
            </button>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] ?? 12 }}</p>
            <p class="text-xs text-gray-600">Total Realtors</p>
        </div>
        <div class="bg-green-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-green-900">{{ $stats['active'] ?? 10 }}</p>
            <p class="text-xs text-green-600">Active</p>
        </div>
        <div class="bg-yellow-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-yellow-900">{{ $stats['pending'] ?? 2 }}</p>
            <p class="text-xs text-yellow-600">Pending Invite</p>
        </div>
        <div class="bg-blue-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-blue-900">{{ $stats['total_leads'] ?? 156 }}</p>
            <p class="text-xs text-blue-600">Total Leads</p>
        </div>
        <div class="bg-purple-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-purple-900">${{ number_format($stats['total_commissions'] ?? 125000, 0) }}</p>
            <p class="text-xs text-purple-600">Total Commissions</p>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <input type="text" placeholder="Search realtors..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option>All Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                    <option>Pending</option>
                </select>
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option>All Branches</option>
                    @foreach($branches ?? [] as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Realtors Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($realtors ?? [] as $realtor)
            <div class="bg-white rounded-lg shadow hover:shadow-xl transition">
                <!-- Header with Avatar -->
                <div class="relative">
                    <div class="h-24 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-t-lg"></div>
                    <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                        <img class="h-24 w-24 rounded-full border-4 border-white object-cover"
                             src="https://ui-avatars.com/api/?name={{ urlencode($realtor->name ?? 'Realtor') }}&size=200&background=4F46E5&color=ffffff"
                             alt="{{ $realtor->name ?? 'Realtor' }}">
                    </div>
                    <!-- Status Badge -->
                    <div class="absolute top-2 right-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ ($realtor->status ?? 'active') === 'active' ? 'bg-green-100 text-green-800' : '' }}
                            {{ ($realtor->status ?? '') === 'inactive' ? 'bg-gray-100 text-gray-800' : '' }}
                            {{ ($realtor->status ?? '') === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                            {{ ucfirst($realtor->status ?? 'active') }}
                        </span>
                    </div>
                </div>

                <!-- Profile Info -->
                <div class="pt-14 pb-6 px-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $realtor->name ?? 'John Doe' }}</h3>
                    <p class="text-sm text-gray-500 mb-1">{{ $realtor->email ?? 'john@agency.com' }}</p>
                    <p class="text-sm text-gray-500 mb-3">
                        <i class="fas fa-phone mr-1"></i>
                        {{ $realtor->phone ?? '+1234567890' }}
                    </p>
                    <p class="text-xs text-gray-400">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        {{ $realtor->branch_name ?? 'Main Office' }}
                    </p>
                </div>

                <!-- Stats -->
                <div class="border-t border-gray-200 px-6 py-4">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <p class="text-lg font-bold text-gray-900">{{ $realtor->leads_count ?? 24 }}</p>
                            <p class="text-xs text-gray-600">Leads</p>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-gray-900">{{ $realtor->clients_count ?? 18 }}</p>
                            <p class="text-xs text-gray-600">Clients</p>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-gray-900">{{ $realtor->properties_count ?? 12 }}</p>
                            <p class="text-xs text-gray-600">Properties</p>
                        </div>
                    </div>
                </div>

                <!-- Performance -->
                <div class="border-t border-gray-200 px-6 py-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-600">Commission (This Month)</span>
                        <span class="text-sm font-bold text-green-600">${{ number_format($realtor->commission ?? 8500, 0) }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ $realtor->performance ?? 75 }}%"></div>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-xs text-gray-500">Performance</span>
                        <span class="text-xs font-medium text-gray-900">{{ $realtor->performance ?? 75 }}%</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="border-t border-gray-200 px-6 py-3 bg-gray-50 rounded-b-lg">
                    <div class="flex justify-between items-center">
                        <button onclick="window.location.href='{{ route('agency.realtors.show', $realtor->id ?? 1) }}'"
                                class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                            <i class="fas fa-eye mr-1"></i> View Profile
                        </button>
                        <div class="flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-700 p-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-gray-600 hover:text-gray-700 p-1" title="Message">
                                <i class="fas fa-envelope"></i>
                            </button>
                            @if(($realtor->status ?? 'active') === 'active')
                                <button class="text-yellow-600 hover:text-yellow-700 p-1" title="Deactivate">
                                    <i class="fas fa-pause-circle"></i>
                                </button>
                            @else
                                <button class="text-green-600 hover:text-green-700 p-1" title="Activate">
                                    <i class="fas fa-play-circle"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12 bg-white rounded-lg shadow">
                <i class="fas fa-user-tie text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg font-medium">No team members found</p>
                <p class="text-gray-400 text-sm mt-1">Start by adding your first realtor</p>
                <button onclick="window.location.href='{{ route('agency.realtors.create') }}'" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md">
                    <i class="fas fa-plus mr-2"></i>Add First Realtor
                </button>
            </div>
        @endforelse
    </div>

    <!-- Top Performers -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-trophy mr-2 text-yellow-500"></i>
                Top Performers This Month
            </h2>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Rank</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Realtor</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Deals Closed</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Revenue Generated</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Commission Earned</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Conversion Rate</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($topPerformers ?? [] as $index => $performer)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($index === 0)
                                        <i class="fas fa-crown text-yellow-500 text-xl"></i>
                                    @elseif($index === 1)
                                        <i class="fas fa-medal text-gray-400 text-xl"></i>
                                    @elseif($index === 2)
                                        <i class="fas fa-medal text-orange-600 text-xl"></i>
                                    @else
                                        <span class="text-gray-500 font-medium">#{{ $index + 1 }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($performer->name ?? 'User') }}" alt="">
                                        <span class="ml-3 font-medium text-gray-900">{{ $performer->name ?? 'Realtor Name' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $performer->deals ?? 8 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${{ number_format($performer->revenue ?? 450000, 0) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">${{ number_format($performer->commission ?? 13500, 0) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $performer->conversion_rate ?? 32 }}%</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
