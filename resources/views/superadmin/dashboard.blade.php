@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-tachometer-alt mr-2 text-indigo-600"></i>
                Super Admin Dashboard
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Platform overview and management
            </p>
        </div>
        <div>
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Create Agency
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Agencies -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Agencies</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_agencies'] ?? 42 }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up"></i> 12% from last month
                    </p>
                </div>
                <div class="bg-indigo-100 rounded-full p-4">
                    <i class="fas fa-building text-indigo-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Active Subscriptions -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Active Subscriptions</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['active_subscriptions'] ?? 38 }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up"></i> 8% from last month
                    </p>
                </div>
                <div class="bg-green-100 rounded-full p-4">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Monthly Revenue -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Monthly Revenue</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">${{ number_format($stats['monthly_revenue'] ?? 24500, 0) }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up"></i> 15% from last month
                    </p>
                </div>
                <div class="bg-yellow-100 rounded-full p-4">
                    <i class="fas fa-dollar-sign text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_users'] ?? 1248 }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up"></i> 22% from last month
                    </p>
                </div>
                <div class="bg-purple-100 rounded-full p-4">
                    <i class="fas fa-users text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Agencies & Revenue Chart -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Agencies -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-building mr-2 text-gray-600"></i>
                    Recent Agencies
                </h2>
                <a href="{{ route('superadmin.agencies.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($recentAgencies ?? [] as $agency)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center">
                                <div class="bg-indigo-600 rounded-full h-10 w-10 flex items-center justify-center text-white font-bold">
                                    {{ substr($agency->name, 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">{{ $agency->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $agency->email }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ ucfirst($agency->status) }}
                                </span>
                                <p class="text-xs text-gray-500 mt-1">{{ $agency->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No recent agencies</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Revenue Chart -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-chart-line mr-2 text-gray-600"></i>
                    Revenue Overview
                </h2>
            </div>
            <div class="p-6">
                <canvas id="revenueChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Subscription Plans Overview -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-tags mr-2 text-gray-600"></i>
                Subscription Plans Distribution
            </h2>
            <a href="{{ route('superadmin.plans.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                Manage Plans <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="border border-gray-200 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold text-gray-900">{{ $planStats['free'] ?? 8 }}</p>
                    <p class="text-sm text-gray-600 mt-1">Free Trial</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold text-gray-900">{{ $planStats['basic'] ?? 15 }}</p>
                    <p class="text-sm text-gray-600 mt-1">Basic Plan</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold text-gray-900">{{ $planStats['professional'] ?? 12 }}</p>
                    <p class="text-sm text-gray-600 mt-1">Professional Plan</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold text-gray-900">{{ $planStats['enterprise'] ?? 7 }}</p>
                    <p class="text-sm text-gray-600 mt-1">Enterprise Plan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-bolt mr-2 text-gray-600"></i>
                Quick Actions
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('superadmin.agencies.create') }}" class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition group">
                    <div class="bg-indigo-100 group-hover:bg-indigo-200 rounded-full p-3">
                        <i class="fas fa-plus text-indigo-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="font-medium text-gray-900">Create New Agency</p>
                        <p class="text-sm text-gray-500">Add a new agency to platform</p>
                    </div>
                </a>
                <a href="{{ route('superadmin.plans.create') }}" class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition group">
                    <div class="bg-green-100 group-hover:bg-green-200 rounded-full p-3">
                        <i class="fas fa-tag text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="font-medium text-gray-900">Create Subscription Plan</p>
                        <p class="text-sm text-gray-500">Add new pricing tier</p>
                    </div>
                </a>
                <a href="{{ route('superadmin.themes.create') }}" class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition group">
                    <div class="bg-purple-100 group-hover:bg-purple-200 rounded-full p-3">
                        <i class="fas fa-palette text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="font-medium text-gray-900">Upload New Theme</p>
                        <p class="text-sm text-gray-500">Add theme to marketplace</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Revenue ($)',
                data: [12000, 15000, 13500, 18000, 21000, 24500],
                borderColor: 'rgb(79, 70, 229)',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
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
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection
