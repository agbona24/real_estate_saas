@extends('layouts.app')

@section('title', 'Followups & Tasks')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-tasks mr-2 text-indigo-600"></i>
                Followups & Tasks
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Track client followups and manage your daily tasks
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-filter mr-2"></i>
                Filter
            </button>
            <button onclick="window.location.href='{{ route('realtor.followups.create') }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add Followup
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Due Today</p>
                    <p class="text-3xl font-bold text-red-600">{{ $stats['due_today'] ?? 8 }}</p>
                </div>
                <i class="fas fa-exclamation-circle text-red-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">This Week</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['this_week'] ?? 24 }}</p>
                </div>
                <i class="fas fa-calendar-week text-blue-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Completed</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['completed'] ?? 156 }}</p>
                </div>
                <i class="fas fa-check-circle text-green-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Overdue</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $stats['overdue'] ?? 3 }}</p>
                </div>
                <i class="fas fa-clock text-yellow-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Followups List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow">
                <!-- Tabs -->
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px px-6" x-data="{ tab: 'pending' }">
                        <button @click="tab = 'pending'" :class="tab === 'pending' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm">
                            <i class="fas fa-clock mr-1"></i> Pending ({{ $counts['pending'] ?? 32 }})
                        </button>
                        <button @click="tab = 'today'" :class="tab === 'today' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm">
                            <i class="fas fa-calendar-day mr-1"></i> Today ({{ $counts['today'] ?? 8 }})
                        </button>
                        <button @click="tab = 'completed'" :class="tab === 'completed' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm">
                            <i class="fas fa-check-circle mr-1"></i> Completed
                        </button>
                        <button @click="tab = 'overdue'" :class="tab === 'overdue' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm">
                            <i class="fas fa-exclamation-triangle mr-1"></i> Overdue ({{ $counts['overdue'] ?? 3 }})
                        </button>
                    </nav>
                </div>

                <!-- Followups List -->
                <div class="divide-y divide-gray-200">
                    @forelse($followups ?? [] as $followup)
                        <div class="p-4 hover:bg-gray-50 transition">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-3 flex-1">
                                    <!-- Checkbox -->
                                    <input type="checkbox" {{ ($followup->status ?? '') === 'completed' ? 'checked' : '' }} class="mt-1 h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">

                                    <!-- Content -->
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h3 class="text-sm font-medium text-gray-900 {{ ($followup->status ?? '') === 'completed' ? 'line-through text-gray-500' : '' }}">
                                                    {{ $followup->title ?? 'Follow up with client about property viewing' }}
                                                </h3>
                                                <p class="text-sm text-gray-600 mt-1">{{ $followup->description ?? 'Discuss pricing and schedule site visit for Beverly Hills property.' }}</p>
                                            </div>
                                        </div>

                                        <!-- Meta Info -->
                                        <div class="flex items-center space-x-4 mt-3 text-xs text-gray-500">
                                            <div class="flex items-center">
                                                <i class="fas fa-user mr-1"></i>
                                                <span>{{ $followup->client_name ?? 'John Doe' }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar mr-1"></i>
                                                <span>{{ $followup->due_date ?? 'Nov 16, 2025' }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-clock mr-1"></i>
                                                <span>{{ $followup->due_time ?? '2:00 PM' }}</span>
                                            </div>
                                            @if($followup->property_title ?? null)
                                                <div class="flex items-center">
                                                    <i class="fas fa-home mr-1"></i>
                                                    <span>{{ $followup->property_title }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Tags -->
                                        <div class="flex items-center space-x-2 mt-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                                {{ ($followup->priority ?? 'medium') === 'high' ? 'bg-red-100 text-red-800' : '' }}
                                                {{ ($followup->priority ?? 'medium') === 'medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ ($followup->priority ?? 'medium') === 'low' ? 'bg-green-100 text-green-800' : '' }}">
                                                {{ ucfirst($followup->priority ?? 'medium') }} Priority
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ ucfirst($followup->type ?? 'call') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex items-center space-x-2 ml-4">
                                    <button class="text-green-600 hover:text-green-700 p-1" title="Mark Complete">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="text-blue-600 hover:text-blue-700 p-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-purple-600 hover:text-purple-700 p-1" title="Reschedule">
                                        <i class="fas fa-calendar-alt"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-700 p-1" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <i class="fas fa-tasks text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500 text-lg font-medium">No followups scheduled</p>
                            <p class="text-gray-400 text-sm mt-1">Create your first followup to get started</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Add -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Quick Add Task</h3>
                <form class="space-y-3">
                    <div>
                        <input type="text" placeholder="Task title..." class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                    </div>
                    <div>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <option>Select Client</option>
                            @foreach($clients ?? [] as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <input type="date" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                        <input type="time" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                    </div>
                    <div>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <option>Type</option>
                            <option value="call">Phone Call</option>
                            <option value="email">Email</option>
                            <option value="meeting">Meeting</option>
                            <option value="viewing">Property Viewing</option>
                            <option value="followup">General Followup</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i> Add Task
                    </button>
                </form>
            </div>

            <!-- Upcoming This Week -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-calendar-week mr-2 text-gray-600"></i>
                        Upcoming This Week
                    </h3>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        @foreach($upcomingWeek ?? [] as $day => $count)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $day ?? 'Monday' }}</p>
                                    <p class="text-xs text-gray-500">{{ $count ?? 3 }} tasks</p>
                                </div>
                                <span class="text-2xl font-bold text-indigo-600">{{ $count ?? 3 }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Performance Stats -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-chart-line mr-2 text-gray-600"></i>
                        This Month
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Completion Rate</span>
                            <span class="font-medium text-gray-900">{{ $performance['rate'] ?? 87 }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ $performance['rate'] ?? 87 }}%"></div>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-gray-200">
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-600">Total Tasks</span>
                            <span class="text-sm font-medium text-gray-900">{{ $performance['total'] ?? 124 }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-600">Completed</span>
                            <span class="text-sm font-medium text-green-600">{{ $performance['completed'] ?? 108 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Pending</span>
                            <span class="text-sm font-medium text-yellow-600">{{ $performance['pending'] ?? 16 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
