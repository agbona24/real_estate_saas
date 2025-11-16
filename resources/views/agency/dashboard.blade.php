@extends('layouts.app')

@section('title', 'Agency Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-tachometer-alt mr-2 text-indigo-600"></i>
                Agency Dashboard
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Welcome back, {{ auth()->user()->name }}!
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-download mr-2"></i>
                Export Report
            </button>
            <button onclick="window.location.href='{{ route('agency.leads.create') }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add Lead
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Leads -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Leads</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_leads'] ?? 156 }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up"></i> 18 new this week
                    </p>
                </div>
                <div class="bg-blue-100 rounded-full p-4">
                    <i class="fas fa-user-plus text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Active Clients -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Active Clients</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['active_clients'] ?? 84 }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up"></i> 7 new this week
                    </p>
                </div>
                <div class="bg-green-100 rounded-full p-4">
                    <i class="fas fa-users text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Properties Listed -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Properties Listed</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_properties'] ?? 245 }}</p>
                    <p class="text-sm text-yellow-600 mt-1">
                        <i class="fas fa-clock"></i> 12 pending approval
                    </p>
                </div>
                <div class="bg-yellow-100 rounded-full p-4">
                    <i class="fas fa-home text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">${{ number_format($stats['total_revenue'] ?? 482500, 0) }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up"></i> $25K this month
                    </p>
                </div>
                <div class="bg-purple-100 rounded-full p-4">
                    <i class="fas fa-dollar-sign text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- CRM Pipeline & Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- CRM Pipeline -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-chart-bar mr-2 text-gray-600"></i>
                    CRM Pipeline
                </h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-7 gap-2 text-center">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-gray-900">{{ $pipeline['new'] ?? 32 }}</p>
                        <p class="text-xs text-gray-600 mt-1">New</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-blue-900">{{ $pipeline['contacted'] ?? 28 }}</p>
                        <p class="text-xs text-blue-600 mt-1">Contacted</p>
                    </div>
                    <div class="bg-indigo-50 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-indigo-900">{{ $pipeline['qualified'] ?? 24 }}</p>
                        <p class="text-xs text-indigo-600 mt-1">Qualified</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-purple-900">{{ $pipeline['proposal'] ?? 18 }}</p>
                        <p class="text-xs text-purple-600 mt-1">Proposal</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-yellow-900">{{ $pipeline['negotiation'] ?? 15 }}</p>
                        <p class="text-xs text-yellow-600 mt-1">Negotiation</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-green-900">{{ $pipeline['won'] ?? 22 }}</p>
                        <p class="text-xs text-green-600 mt-1">Won</p>
                    </div>
                    <div class="bg-red-50 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-red-900">{{ $pipeline['lost'] ?? 17 }}</p>
                        <p class="text-xs text-red-600 mt-1">Lost</p>
                    </div>
                </div>
                <div class="mt-6">
                    <canvas id="pipelineChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-history mr-2 text-gray-600"></i>
                    Recent Activities
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    @forelse($recentActivities ?? [] as $activity)
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="bg-{{ $activity->color ?? 'gray' }}-100 rounded-full h-8 w-8 flex items-center justify-center">
                                    <i class="fas fa-{{ $activity->icon ?? 'info' }} text-{{ $activity->color ?? 'gray' }}-600 text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm text-gray-900">{{ $activity->description ?? 'Activity description' }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $activity->created_at ?? now() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                            <p class="text-gray-500 text-sm">No recent activities</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Leads & Top Properties -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Leads -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-user-plus mr-2 text-gray-600"></i>
                    Recent Leads
                </h2>
                <a href="{{ route('agency.leads.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse($recentLeads ?? [] as $lead)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center">
                                <div class="bg-blue-600 rounded-full h-10 w-10 flex items-center justify-center text-white font-bold">
                                    {{ substr($lead->name, 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">{{ $lead->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $lead->email }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $lead->status_color ?? 'gray' }}-100 text-{{ $lead->status_color ?? 'gray' }}-800">
                                    {{ ucfirst($lead->status ?? 'new') }}
                                </span>
                                <p class="text-xs text-gray-500 mt-1">{{ $lead->created_at ?? now() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No recent leads</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Top Properties -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-fire mr-2 text-gray-600"></i>
                    Top Performing Properties
                </h2>
                <a href="{{ route('agency.properties.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse($topProperties ?? [] as $property)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center">
                                <img src="{{ $property->image ?? 'https://via.placeholder.com/60' }}" alt="{{ $property->title }}" class="w-12 h-12 rounded object-cover">
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">{{ $property->title ?? 'Property Title' }}</p>
                                    <p class="text-sm text-gray-500">${{ number_format($property->price ?? 250000, 0) }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ $property->views ?? 0 }} views</p>
                                <p class="text-xs text-gray-500">{{ $property->inquiries ?? 0 }} inquiries</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No properties listed</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Team Performance -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-user-tie mr-2 text-gray-600"></i>
                Team Performance
            </h2>
            <a href="{{ route('agency.realtors.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                Manage Team <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Realtor</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leads</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Clients</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Properties</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Revenue</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Performance</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($teamPerformance ?? [] as $member)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($member->name ?? 'User') }}" alt="">
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $member->name ?? 'Realtor Name' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $member->leads ?? 0 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $member->clients ?? 0 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $member->properties ?? 0 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($member->revenue ?? 0, 0) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-24 bg-gray-200 rounded-full h-2 mr-2">
                                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ $member->performance ?? 75 }}%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600">{{ $member->performance ?? 75 }}%</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No team members found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pipeline Conversion Chart
    const ctx = document.getElementById('pipelineChart').getContext('2d');
    const pipelineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['New', 'Contacted', 'Qualified', 'Proposal', 'Negotiation', 'Won', 'Lost'],
            datasets: [{
                label: 'Leads',
                data: [32, 28, 24, 18, 15, 22, 17],
                backgroundColor: [
                    'rgba(156, 163, 175, 0.5)',
                    'rgba(59, 130, 246, 0.5)',
                    'rgba(99, 102, 241, 0.5)',
                    'rgba(139, 92, 246, 0.5)',
                    'rgba(234, 179, 8, 0.5)',
                    'rgba(34, 197, 94, 0.5)',
                    'rgba(239, 68, 68, 0.5)'
                ],
                borderColor: [
                    'rgb(156, 163, 175)',
                    'rgb(59, 130, 246)',
                    'rgb(99, 102, 241)',
                    'rgb(139, 92, 246)',
                    'rgb(234, 179, 8)',
                    'rgb(34, 197, 94)',
                    'rgb(239, 68, 68)'
                ],
                borderWidth: 1
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
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
@endsection
