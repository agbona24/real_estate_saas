@extends('layouts.app')

@section('title', 'Appointments & Meetings')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-calendar-alt mr-2 text-indigo-600"></i>
                Appointments & Meetings
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Schedule and manage client appointments and property viewings
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-download mr-2"></i>
                Export Calendar
            </button>
            <button onclick="window.location.href='{{ route('realtor.appointments.create') }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Schedule Appointment
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Today</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $stats['today'] ?? 5 }}</p>
                </div>
                <i class="fas fa-calendar-day text-indigo-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">This Week</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['week'] ?? 18 }}</p>
                </div>
                <i class="fas fa-calendar-week text-blue-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Viewings</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['viewings'] ?? 12 }}</p>
                </div>
                <i class="fas fa-home text-green-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Meetings</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $stats['meetings'] ?? 6 }}</p>
                </div>
                <i class="fas fa-handshake text-purple-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Calendar and List View -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Mini Calendar -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-calendar mr-2 text-gray-600"></i>
                        November 2025
                    </h2>
                    <div class="flex space-x-2">
                        <button class="p-2 hover:bg-gray-100 rounded">
                            <i class="fas fa-chevron-left text-gray-600"></i>
                        </button>
                        <button class="px-3 py-1 text-sm bg-indigo-600 text-white rounded">Today</button>
                        <button class="p-2 hover:bg-gray-100 rounded">
                            <i class="fas fa-chevron-right text-gray-600"></i>
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <!-- Calendar Grid -->
                    <div class="grid grid-cols-7 gap-2">
                        <!-- Day Headers -->
                        @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                            <div class="text-center text-xs font-semibold text-gray-600 py-2">{{ $day }}</div>
                        @endforeach

                        <!-- Calendar Days -->
                        @for($i = 1; $i <= 30; $i++)
                            <div class="aspect-square border border-gray-200 rounded-lg p-1 hover:bg-gray-50 cursor-pointer {{ $i === 16 ? 'bg-indigo-50 border-indigo-300' : '' }}">
                                <div class="text-sm font-medium {{ $i === 16 ? 'text-indigo-600' : 'text-gray-900' }}">{{ $i }}</div>
                                @if($i === 16 || $i === 18 || $i === 20)
                                    <div class="mt-1 space-y-0.5">
                                        <div class="w-full h-1 bg-green-500 rounded"></div>
                                        @if($i === 16)
                                            <div class="w-full h-1 bg-blue-500 rounded"></div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Appointments List -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Today's Schedule</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($appointments ?? [] as $appointment)
                        <div class="p-4 hover:bg-gray-50 transition">
                            <div class="flex items-start space-x-4">
                                <!-- Time -->
                                <div class="flex-shrink-0 text-center">
                                    <p class="text-sm font-semibold text-gray-900">{{ $appointment->time ?? '10:00' }}</p>
                                    <p class="text-xs text-gray-500">{{ $appointment->duration ?? '1h' }}</p>
                                </div>

                                <!-- Vertical Line -->
                                <div class="flex-shrink-0 w-px bg-gray-300"></div>

                                <!-- Content -->
                                <div class="flex-1">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <div class="flex items-center space-x-2 mb-1">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                                    {{ ($appointment->type ?? 'viewing') === 'viewing' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ ($appointment->type ?? '') === 'meeting' ? 'bg-blue-100 text-blue-800' : '' }}
                                                    {{ ($appointment->type ?? '') === 'consultation' ? 'bg-purple-100 text-purple-800' : '' }}">
                                                    <i class="fas fa-{{ ($appointment->type ?? 'viewing') === 'viewing' ? 'home' : (($appointment->type ?? '') === 'meeting' ? 'handshake' : 'user') }} mr-1"></i>
                                                    {{ ucfirst($appointment->type ?? 'viewing') }}
                                                </span>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                                    {{ ($appointment->status ?? 'scheduled') === 'scheduled' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                    {{ ($appointment->status ?? '') === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ ($appointment->status ?? '') === 'completed' ? 'bg-gray-100 text-gray-800' : '' }}
                                                    {{ ($appointment->status ?? '') === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                    {{ ucfirst($appointment->status ?? 'scheduled') }}
                                                </span>
                                            </div>
                                            <h3 class="text-sm font-semibold text-gray-900 mb-1">
                                                {{ $appointment->title ?? 'Property Viewing - Luxury Villa' }}
                                            </h3>
                                            <div class="space-y-1 text-sm text-gray-600">
                                                <div class="flex items-center">
                                                    <i class="fas fa-user w-4 mr-2 text-gray-400"></i>
                                                    <span>{{ $appointment->client_name ?? 'John Doe' }}</span>
                                                </div>
                                                @if($appointment->property_address ?? null)
                                                    <div class="flex items-center">
                                                        <i class="fas fa-map-marker-alt w-4 mr-2 text-gray-400"></i>
                                                        <span>{{ $appointment->property_address }}</span>
                                                    </div>
                                                @endif
                                                @if($appointment->location ?? null)
                                                    <div class="flex items-center">
                                                        <i class="fas fa-building w-4 mr-2 text-gray-400"></i>
                                                        <span>{{ $appointment->location }}</span>
                                                    </div>
                                                @endif
                                                @if($appointment->notes ?? null)
                                                    <div class="flex items-start">
                                                        <i class="fas fa-sticky-note w-4 mr-2 mt-0.5 text-gray-400"></i>
                                                        <span class="text-xs">{{ $appointment->notes }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex items-center space-x-2">
                                            <button class="text-green-600 hover:text-green-700 p-1" title="Mark Complete">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="text-blue-600 hover:text-blue-700 p-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-purple-600 hover:text-purple-700 p-1" title="Reschedule">
                                                <i class="fas fa-clock"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-700 p-1" title="Cancel">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <i class="fas fa-calendar-alt text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500 text-lg font-medium">No appointments scheduled</p>
                            <p class="text-gray-400 text-sm mt-1">Schedule your first appointment to get started</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Schedule -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-plus-circle mr-2 text-indigo-600"></i>
                    Quick Schedule
                </h3>
                <form class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Type</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <option value="viewing">Property Viewing</option>
                            <option value="meeting">Client Meeting</option>
                            <option value="consultation">Consultation</option>
                            <option value="followup">Follow-up</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Client</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <option>Select Client</option>
                            @foreach($clients ?? [] as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Start Time</label>
                            <input type="time" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Duration</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                                <option>30 min</option>
                                <option>1 hour</option>
                                <option>1.5 hours</option>
                                <option>2 hours</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-calendar-check mr-2"></i> Schedule
                    </button>
                </form>
            </div>

            <!-- Upcoming This Week -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-list mr-2 text-gray-600"></i>
                        Upcoming This Week
                    </h3>
                </div>
                <div class="p-4">
                    <div class="space-y-2">
                        @foreach($upcomingWeek ?? [] as $day)
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="text-xs text-gray-500">{{ $day['date'] ?? 'Monday, Nov 18' }}</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $day['count'] ?? 3 }} appointments</p>
                                    </div>
                                    <span class="text-xl font-bold text-indigo-600">{{ $day['count'] ?? 3 }}</span>
                                </div>
                                <div class="flex space-x-1">
                                    @for($i = 0; $i < ($day['count'] ?? 3); $i++)
                                        <div class="h-1 flex-1 bg-{{ $i === 0 ? 'green' : ($i === 1 ? 'blue' : 'purple') }}-500 rounded"></div>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-history mr-2 text-gray-600"></i>
                        Recent Activity
                    </h3>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        @foreach($recentActivity ?? [] as $activity)
                            <div class="flex items-start space-x-2 text-sm">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="h-6 w-6 rounded-full flex items-center justify-center
                                        {{ ($activity->action ?? 'scheduled') === 'scheduled' ? 'bg-green-100' : '' }}
                                        {{ ($activity->action ?? '') === 'completed' ? 'bg-blue-100' : '' }}
                                        {{ ($activity->action ?? '') === 'cancelled' ? 'bg-red-100' : '' }}">
                                        <i class="fas fa-{{ ($activity->action ?? 'scheduled') === 'scheduled' ? 'plus' : (($activity->action ?? '') === 'completed' ? 'check' : 'times') }}
                                            {{ ($activity->action ?? 'scheduled') === 'scheduled' ? 'text-green-600' : '' }}
                                            {{ ($activity->action ?? '') === 'completed' ? 'text-blue-600' : '' }}
                                            {{ ($activity->action ?? '') === 'cancelled' ? 'text-red-600' : '' }} text-xs"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-gray-900">
                                        <span class="font-medium">{{ ucfirst($activity->action ?? 'scheduled') }}</span>
                                        {{ $activity->type ?? 'viewing' }} with
                                        <span class="font-medium">{{ $activity->client ?? 'John Doe' }}</span>
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $activity->time ?? '2 hours ago' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
