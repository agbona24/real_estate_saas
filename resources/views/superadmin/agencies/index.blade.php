@extends('layouts.app')

@section('title', 'Manage Agencies')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-building mr-2 text-indigo-600"></i>
                Agencies Management
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Manage all real estate agencies on the platform
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-download mr-2"></i>
                Export Data
            </button>
            <button onclick="window.location.href='{{ route('superadmin.agencies.create') }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i>
                New Agency
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] ?? 156 }}</p>
            <p class="text-xs text-gray-600">Total Agencies</p>
        </div>
        <div class="bg-green-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-green-900">{{ $stats['active'] ?? 142 }}</p>
            <p class="text-xs text-green-600">Active</p>
        </div>
        <div class="bg-yellow-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-yellow-900">{{ $stats['trial'] ?? 8 }}</p>
            <p class="text-xs text-yellow-600">Trial Period</p>
        </div>
        <div class="bg-red-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-red-900">{{ $stats['suspended'] ?? 6 }}</p>
            <p class="text-xs text-red-600">Suspended</p>
        </div>
        <div class="bg-purple-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-purple-900">${{ number_format($stats['mrr'] ?? 47600, 0) }}</p>
            <p class="text-xs text-purple-600">Monthly Revenue</p>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-lg shadow">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px space-x-8 px-6" x-data="{ tab: 'all' }">
                <button @click="tab = 'all'" :class="tab === 'all' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    All Agencies
                </button>
                <button @click="tab = 'active'" :class="tab === 'active' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    <i class="fas fa-check-circle mr-1"></i> Active
                </button>
                <button @click="tab = 'trial'" :class="tab === 'trial' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    <i class="fas fa-clock mr-1"></i> Trial
                </button>
                <button @click="tab = 'suspended'" :class="tab === 'suspended' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    <i class="fas fa-ban mr-1"></i> Suspended
                </button>
            </nav>
        </div>

        <!-- Search and Filters -->
        <div class="p-4 border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <input type="text" placeholder="Search agencies by name, email, or domain..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option>All Plans</option>
                        <option>Starter</option>
                        <option>Professional</option>
                        <option>Enterprise</option>
                    </select>
                </div>
                <div>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option>Sort: Newest First</option>
                        <option>Sort: Oldest First</option>
                        <option>Sort: Name A-Z</option>
                        <option>Sort: Revenue High-Low</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Agencies List -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Agency</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Admin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Users/Limit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Properties</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">MRR</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($agencies ?? [] as $agency)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-lg" src="{{ $agency->logo ?? 'https://ui-avatars.com/api/?name='.urlencode($agency->name ?? 'Agency') }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $agency->name ?? 'Premier Realty' }}</div>
                                        <div class="text-xs text-gray-500">{{ $agency->subdomain ?? 'premier' }}.domain.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $agency->admin_name ?? 'John Doe' }}</div>
                                <div class="text-xs text-gray-500">{{ $agency->admin_email ?? 'john@premier.com' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ ($agency->plan ?? 'professional') === 'starter' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ ($agency->plan ?? 'professional') === 'professional' ? 'bg-purple-100 text-purple-800' : '' }}
                                    {{ ($agency->plan ?? 'professional') === 'enterprise' ? 'bg-indigo-100 text-indigo-800' : '' }}">
                                    {{ ucfirst($agency->plan ?? 'professional') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex items-center">
                                    <span class="font-medium text-gray-900">{{ $agency->users_count ?? 12 }}</span>
                                    <span class="text-gray-500 mx-1">/</span>
                                    <span class="text-gray-500">{{ $agency->users_limit ?? 50 }}</span>
                                </div>
                                <div class="w-24 bg-gray-200 rounded-full h-1.5 mt-1">
                                    <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ (($agency->users_count ?? 12) / ($agency->users_limit ?? 50)) * 100 }}%"></div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $agency->properties_count ?? 245 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">
                                ${{ number_format($agency->mrr ?? 299, 0) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $agency->created_at ?? 'Nov 1, 2024' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ ($agency->status ?? 'active') === 'active' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ ($agency->status ?? '') === 'trial' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ ($agency->status ?? '') === 'suspended' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ ($agency->status ?? '') === 'expired' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    <i class="fas fa-circle mr-1 text-xs"></i>
                                    {{ ucfirst($agency->status ?? 'active') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button onclick="window.location.href='{{ route('superadmin.agencies.show', $agency->id ?? 1) }}'" class="text-indigo-600 hover:text-indigo-900" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-blue-600 hover:text-blue-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-900" title="Login As">
                                        <i class="fas fa-sign-in-alt"></i>
                                    </button>
                                    @if(($agency->status ?? 'active') === 'active')
                                        <button class="text-yellow-600 hover:text-yellow-900" title="Suspend">
                                            <i class="fas fa-pause-circle"></i>
                                        </button>
                                    @else
                                        <button class="text-green-600 hover:text-green-900" title="Activate">
                                            <i class="fas fa-play-circle"></i>
                                        </button>
                                    @endif
                                    <button class="text-red-600 hover:text-red-900" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center">
                                <i class="fas fa-building text-gray-300 text-5xl mb-4"></i>
                                <p class="text-gray-500 text-lg font-medium">No agencies found</p>
                                <p class="text-gray-400 text-sm mt-1">Create your first agency to get started</p>
                                <button onclick="window.location.href='{{ route('superadmin.agencies.create') }}'" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md">
                                    <i class="fas fa-plus mr-2"></i>Create Agency
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

    <!-- Platform Statistics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Monthly Recurring Revenue</h2>
            <div class="h-64">
                <canvas id="revenue-chart"></canvas>
            </div>
        </div>

        <!-- Agency Growth -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Agency Signups (Last 12 Months)</h2>
            <div class="h-64">
                <canvas id="growth-chart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-history mr-2 text-gray-600"></i>
                Recent Activity
            </h2>
        </div>
        <div class="divide-y divide-gray-200">
            @foreach($recent_activity ?? [] as $activity)
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full flex items-center justify-center
                                {{ ($activity->type ?? 'signup') === 'signup' ? 'bg-green-100' : '' }}
                                {{ ($activity->type ?? '') === 'upgrade' ? 'bg-blue-100' : '' }}
                                {{ ($activity->type ?? '') === 'payment' ? 'bg-purple-100' : '' }}
                                {{ ($activity->type ?? '') === 'suspension' ? 'bg-red-100' : '' }}">
                                <i class="fas fa-{{ ($activity->type ?? 'signup') === 'signup' ? 'plus' : (($activity->type ?? '') === 'upgrade' ? 'arrow-up' : (($activity->type ?? '') === 'payment' ? 'dollar-sign' : 'ban')) }}
                                    {{ ($activity->type ?? 'signup') === 'signup' ? 'text-green-600' : '' }}
                                    {{ ($activity->type ?? '') === 'upgrade' ? 'text-blue-600' : '' }}
                                    {{ ($activity->type ?? '') === 'payment' ? 'text-purple-600' : '' }}
                                    {{ ($activity->type ?? '') === 'suspension' ? 'text-red-600' : '' }}"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $activity->description ?? 'New agency "Premier Realty" signed up' }}</p>
                            <p class="text-xs text-gray-500">{{ $activity->time ?? '2 hours ago' }}</p>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $activity->detail ?? 'Professional Plan' }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Revenue Chart
const revenueCtx = document.getElementById('revenue-chart');
if (revenueCtx) {
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'MRR',
                data: [28000, 31000, 33500, 35800, 38200, 40500, 42300, 44100, 45200, 46300, 47100, 47600],
                borderColor: 'rgb(99, 102, 241)',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + (value / 1000) + 'k';
                        }
                    }
                }
            }
        }
    });
}

// Growth Chart
const growthCtx = document.getElementById('growth-chart');
if (growthCtx) {
    new Chart(growthCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'New Agencies',
                data: [8, 12, 15, 11, 14, 18, 16, 13, 19, 17, 21, 24],
                backgroundColor: 'rgba(99, 102, 241, 0.8)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5
                    }
                }
            }
        }
    });
}
</script>
@endsection
