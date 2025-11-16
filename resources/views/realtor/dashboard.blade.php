@extends('layouts.app')

@section('title', 'Realtor Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-user-tie mr-2 text-indigo-600"></i>
                My Dashboard
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Welcome back, {{ auth()->user()->name }}!
            </p>
        </div>
        <div class="flex space-x-3">
            <button onclick="window.location.href='{{ route('realtor.leads.create') }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add New Lead
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- My Leads -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">My Leads</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['my_leads'] ?? 42 }}</p>
                    <p class="text-sm text-blue-600 mt-1">
                        <i class="fas fa-clock"></i> 8 pending followup
                    </p>
                </div>
                <div class="bg-blue-100 rounded-full p-4">
                    <i class="fas fa-user-plus text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- My Clients -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">My Clients</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['my_clients'] ?? 28 }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up"></i> 4 converted this month
                    </p>
                </div>
                <div class="bg-green-100 rounded-full p-4">
                    <i class="fas fa-users text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- My Properties -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">My Properties</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['my_properties'] ?? 35 }}</p>
                    <p class="text-sm text-yellow-600 mt-1">
                        <i class="fas fa-check-circle"></i> 22 active listings
                    </p>
                </div>
                <div class="bg-yellow-100 rounded-full p-4">
                    <i class="fas fa-home text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- My Commissions -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">My Commissions</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">${{ number_format($stats['my_commissions'] ?? 42500, 0) }}</p>
                    <p class="text-sm text-purple-600 mt-1">
                        <i class="fas fa-dollar-sign"></i> $8,500 this month
                    </p>
                </div>
                <div class="bg-purple-100 rounded-full p-4">
                    <i class="fas fa-chart-line text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Appointments & Tasks -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Today's Appointments -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-calendar-check mr-2 text-gray-600"></i>
                    Today's Appointments
                </h2>
                <a href="{{ route('realtor.appointments.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($todayAppointments ?? [] as $appointment)
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg border-l-4 border-indigo-500">
                            <div class="flex-shrink-0">
                                <div class="bg-indigo-100 rounded-full h-10 w-10 flex items-center justify-center">
                                    <i class="fas fa-clock text-indigo-600"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $appointment->title ?? 'Property Viewing' }}</p>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <i class="fas fa-user mr-1"></i>
                                            {{ $appointment->client_name ?? 'Client Name' }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                            {{ $appointment->location ?? 'Location' }}
                                        </p>
                                    </div>
                                    <span class="text-sm font-medium text-indigo-600">
                                        {{ $appointment->time ?? '10:00 AM' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-calendar-day text-gray-300 text-4xl mb-3"></i>
                            <p class="text-gray-500 text-sm">No appointments scheduled for today</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Pending Tasks -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-tasks mr-2 text-gray-600"></i>
                    Pending Tasks
                </h2>
                <a href="{{ route('realtor.followups.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse($pendingTasks ?? [] as $task)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center">
                                <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $task->title ?? 'Follow up with lead' }}</p>
                                    <p class="text-xs text-gray-500">{{ $task->client_name ?? 'Client Name' }}</p>
                                </div>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full bg-{{ $task->priority_color ?? 'yellow' }}-100 text-{{ $task->priority_color ?? 'yellow' }}-800">
                                {{ ucfirst($task->priority ?? 'medium') }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-check-circle text-gray-300 text-4xl mb-3"></i>
                            <p class="text-gray-500 text-sm">All caught up! No pending tasks.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- My Leads Pipeline -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-funnel-dollar mr-2 text-gray-600"></i>
                My Leads Pipeline
            </h2>
            <a href="{{ route('realtor.leads.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                Manage Leads <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-7 gap-4">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <p class="text-2xl font-bold text-gray-900">{{ $pipeline['new'] ?? 12 }}</p>
                    <p class="text-xs text-gray-600 mt-1">New</p>
                </div>
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <p class="text-2xl font-bold text-blue-900">{{ $pipeline['contacted'] ?? 8 }}</p>
                    <p class="text-xs text-blue-600 mt-1">Contacted</p>
                </div>
                <div class="text-center p-4 bg-indigo-50 rounded-lg">
                    <p class="text-2xl font-bold text-indigo-900">{{ $pipeline['qualified'] ?? 6 }}</p>
                    <p class="text-xs text-indigo-600 mt-1">Qualified</p>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <p class="text-2xl font-bold text-purple-900">{{ $pipeline['proposal'] ?? 5 }}</p>
                    <p class="text-xs text-purple-600 mt-1">Proposal</p>
                </div>
                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                    <p class="text-2xl font-bold text-yellow-900">{{ $pipeline['negotiation'] ?? 4 }}</p>
                    <p class="text-xs text-yellow-600 mt-1">Negotiation</p>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <p class="text-2xl font-bold text-green-900">{{ $pipeline['won'] ?? 6 }}</p>
                    <p class="text-xs text-green-600 mt-1">Won</p>
                </div>
                <div class="text-center p-4 bg-red-50 rounded-lg">
                    <p class="text-2xl font-bold text-red-900">{{ $pipeline['lost'] ?? 1 }}</p>
                    <p class="text-xs text-red-600 mt-1">Lost</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Leads & Top Properties -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- My Recent Leads -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-user-plus mr-2 text-gray-600"></i>
                    My Recent Leads
                </h2>
                <a href="{{ route('realtor.leads.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse($myRecentLeads ?? [] as $lead)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition cursor-pointer">
                            <div class="flex items-center flex-1">
                                <div class="bg-blue-600 rounded-full h-10 w-10 flex items-center justify-center text-white font-bold">
                                    {{ substr($lead->name ?? 'L', 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">{{ $lead->name ?? 'Lead Name' }}</p>
                                    <p class="text-sm text-gray-500">
                                        <i class="fas fa-phone text-xs mr-1"></i>
                                        {{ $lead->phone ?? '+1234567890' }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $lead->status_color ?? 'gray' }}-100 text-{{ $lead->status_color ?? 'gray' }}-800">
                                    {{ ucfirst($lead->status ?? 'new') }}
                                </span>
                                <p class="text-xs text-gray-500 mt-1">{{ $lead->last_contact ?? '2 days ago' }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No recent leads</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Performance This Month -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-chart-line mr-2 text-gray-600"></i>
                    Performance This Month
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Leads Converted -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700">Leads Converted</span>
                            <span class="text-sm font-bold text-gray-900">{{ $performance['converted'] ?? 4 }}/{{ $performance['total_leads'] ?? 15 }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ $performance['conversion_rate'] ?? 27 }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">27% conversion rate</p>
                    </div>

                    <!-- Properties Listed -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700">Properties Listed</span>
                            <span class="text-sm font-bold text-gray-900">{{ $performance['properties_listed'] ?? 8 }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 80%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Target: 10 properties</p>
                    </div>

                    <!-- Commission Earned -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700">Commission Earned</span>
                            <span class="text-sm font-bold text-gray-900">${{ number_format($performance['commission'] ?? 8500, 0) }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $performance['commission_progress'] ?? 85 }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Target: $10,000</p>
                    </div>

                    <!-- Client Satisfaction -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700">Client Satisfaction</span>
                            <span class="text-sm font-bold text-gray-900">{{ $performance['satisfaction'] ?? 4.8 }}/5.0</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                            <span class="ml-2 text-xs text-gray-500">Based on 12 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
