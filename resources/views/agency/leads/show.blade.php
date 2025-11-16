@extends('layouts.app')

@section('title', 'Lead Details')

@section('content')
<div class="space-y-6">
    <!-- Header with Actions -->
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <button onclick="window.history.back()" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left text-xl"></i>
            </button>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $lead->name ?? 'John Doe' }}</h1>
                <p class="text-sm text-gray-600 mt-1">
                    Lead ID: <span class="font-mono">{{ $lead->reference ?? 'LD-2025-001' }}</span> •
                    Added {{ $lead->created_at ?? 'Nov 10, 2025' }}
                </p>
            </div>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-envelope mr-2"></i>
                Send Email
            </button>
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-phone mr-2"></i>
                Call
            </button>
            <button onclick="window.location.href='{{ route('agency.leads.edit', $lead->id ?? 1) }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Edit Lead
            </button>
        </div>
    </div>

    <!-- Quick Status Update -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <span class="text-sm font-medium text-gray-700">Pipeline Status:</span>
                <select class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium
                    {{ ($lead->status ?? 'new') === 'new' ? 'bg-gray-50 text-gray-700' : '' }}
                    {{ ($lead->status ?? '') === 'contacted' ? 'bg-blue-50 text-blue-700' : '' }}
                    {{ ($lead->status ?? '') === 'qualified' ? 'bg-green-50 text-green-700' : '' }}
                    {{ ($lead->status ?? '') === 'proposal' ? 'bg-purple-50 text-purple-700' : '' }}
                    {{ ($lead->status ?? '') === 'negotiation' ? 'bg-yellow-50 text-yellow-700' : '' }}
                    {{ ($lead->status ?? '') === 'won' ? 'bg-emerald-50 text-emerald-700' : '' }}
                    {{ ($lead->status ?? '') === 'lost' ? 'bg-red-50 text-red-700' : '' }}">
                    <option value="new">New Lead</option>
                    <option value="contacted">Contacted</option>
                    <option value="qualified">Qualified</option>
                    <option value="proposal">Proposal Sent</option>
                    <option value="negotiation">Negotiation</option>
                    <option value="won">Won</option>
                    <option value="lost">Lost</option>
                </select>

                <span class="text-sm font-medium text-gray-700">Assigned to:</span>
                <select class="px-4 py-2 border border-gray-300 rounded-md text-sm">
                    <option>{{ $lead->assigned_realtor ?? 'Sarah Johnson' }}</option>
                    @foreach($realtors ?? [] as $realtor)
                        <option value="{{ $realtor->id }}">{{ $realtor->name }}</option>
                    @endforeach
                </select>

                <span class="text-sm font-medium text-gray-700">Priority:</span>
                <select class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium
                    {{ ($lead->priority ?? 'medium') === 'high' ? 'bg-red-50 text-red-700' : '' }}
                    {{ ($lead->priority ?? 'medium') === 'medium' ? 'bg-yellow-50 text-yellow-700' : '' }}
                    {{ ($lead->priority ?? 'medium') === 'low' ? 'bg-green-50 text-green-700' : '' }}">
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
            <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md font-medium">
                <i class="fas fa-arrow-right mr-2"></i>
                Convert to Client
            </button>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-user mr-2 text-gray-600"></i>
                        Contact Information
                    </h2>
                    <button class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Full Name</label>
                            <p class="mt-1 text-sm font-medium text-gray-900">{{ $lead->name ?? 'John Doe' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Email</label>
                            <p class="mt-1 text-sm text-gray-900 flex items-center">
                                <i class="fas fa-envelope text-gray-400 mr-2"></i>
                                {{ $lead->email ?? 'john.doe@example.com' }}
                            </p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Phone</label>
                            <p class="mt-1 text-sm text-gray-900 flex items-center">
                                <i class="fas fa-phone text-gray-400 mr-2"></i>
                                {{ $lead->phone ?? '+1 (555) 123-4567' }}
                            </p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Company</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $lead->company ?? 'Acme Corporation' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Source</label>
                            <p class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst($lead->source ?? 'website') }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Lead Type</label>
                            <p class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    {{ ucfirst($lead->type ?? 'buyer') }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Preferences -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-home mr-2 text-gray-600"></i>
                        Property Preferences
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Property Type</label>
                            <p class="mt-1 text-sm font-medium text-gray-900">{{ $lead->property_type ?? 'House' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Budget Range</label>
                            <p class="mt-1 text-sm font-medium text-gray-900">
                                ${{ number_format($lead->budget_min ?? 200000, 0) }} - ${{ number_format($lead->budget_max ?? 500000, 0) }}
                            </p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Preferred Location</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $lead->preferred_location ?? 'Beverly Hills, CA' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500 uppercase">Bedrooms</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $lead->bedrooms ?? '3-4' }} bedrooms</p>
                        </div>
                        <div class="col-span-2">
                            <label class="text-xs font-medium text-gray-500 uppercase">Special Requirements</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $lead->requirements ?? 'Pool, garage, modern kitchen, garden' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Timeline -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-history mr-2 text-gray-600"></i>
                        Activity Timeline
                    </h2>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-plus mr-2"></i> Add Note
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
                                                    {{ ($activity->type ?? 'note') === 'note' ? 'bg-gray-500' : '' }}
                                                    {{ ($activity->type ?? '') === 'email' ? 'bg-blue-500' : '' }}
                                                    {{ ($activity->type ?? '') === 'call' ? 'bg-green-500' : '' }}
                                                    {{ ($activity->type ?? '') === 'meeting' ? 'bg-purple-500' : '' }}
                                                    {{ ($activity->type ?? '') === 'status_change' ? 'bg-yellow-500' : '' }}">
                                                    <i class="fas fa-{{ ($activity->type ?? 'note') === 'note' ? 'sticky-note' : (($activity->type ?? '') === 'email' ? 'envelope' : (($activity->type ?? '') === 'call' ? 'phone' : (($activity->type ?? '') === 'meeting' ? 'calendar' : 'exchange-alt'))) }} text-white text-xs"></i>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div>
                                                    <div class="text-sm">
                                                        <span class="font-medium text-gray-900">{{ $activity->user ?? 'Sarah Johnson' }}</span>
                                                    </div>
                                                    <p class="mt-0.5 text-sm text-gray-500">{{ $activity->time ?? '2 hours ago' }}</p>
                                                </div>
                                                <div class="mt-2 text-sm text-gray-700">
                                                    <p>{{ $activity->description ?? 'Had a phone call discussion about property requirements. Client is interested in modern villas with pool.' }}</p>
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

            <!-- Notes & Comments -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-comment mr-2 text-gray-600"></i>
                        Internal Notes
                    </h2>
                </div>
                <div class="p-6">
                    <form class="mb-6">
                        <textarea rows="3" placeholder="Add an internal note (not visible to client)..." class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        <div class="mt-2 flex justify-end">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm">
                                Add Note
                            </button>
                        </div>
                    </form>
                    <div class="space-y-4">
                        @foreach($notes ?? [] as $note)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($note->user ?? 'User') }}" class="h-8 w-8 rounded-full" alt="">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $note->user ?? 'Sarah Johnson' }}</p>
                                            <p class="text-xs text-gray-500">{{ $note->time ?? '3 days ago' }}</p>
                                        </div>
                                    </div>
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                                <p class="mt-3 text-sm text-gray-700">{{ $note->content ?? 'Client seems very motivated. Mentioned tight deadline for move-in. Should prioritize showing available properties ASAP.' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Lead Score</h3>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-br from-green-400 to-green-600 text-white">
                        <span class="text-3xl font-bold">{{ $lead->score ?? 85 }}</span>
                    </div>
                    <p class="mt-2 text-sm text-gray-600">High quality lead</p>
                </div>
                <div class="mt-6 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Engagement</span>
                        <span class="font-medium text-gray-900">{{ $lead->engagement ?? 92 }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ $lead->engagement ?? 92 }}%"></div>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Response Rate</span>
                        <span class="font-medium text-gray-900">{{ $lead->response_rate ?? 88 }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $lead->response_rate ?? 88 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Next Action -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-tasks mr-2 text-indigo-600"></i>
                    Next Action
                </h3>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-exclamation-circle text-yellow-600 mt-0.5"></i>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-yellow-900">Follow-up Call Scheduled</p>
                            <p class="text-xs text-yellow-700 mt-1">Tomorrow at 2:00 PM</p>
                            <p class="text-xs text-yellow-600 mt-2">Discuss property viewings for next week</p>
                        </div>
                    </div>
                </div>
                <button class="mt-4 w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm">
                    <i class="fas fa-plus mr-2"></i> Schedule New Action
                </button>
            </div>

            <!-- Matched Properties -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-900">Matched Properties</h3>
                    <span class="text-xs text-gray-500">{{ $matched_count ?? 8 }} matches</span>
                </div>
                <div class="p-4 space-y-3">
                    @foreach($matched_properties ?? [] as $property)
                        <div class="border border-gray-200 rounded-lg p-3 hover:border-indigo-300 cursor-pointer transition">
                            <div class="flex space-x-3">
                                <img src="{{ $property->image ?? 'https://via.placeholder.com/80' }}" class="w-16 h-16 rounded object-cover" alt="">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $property->title ?? '4 Bedroom Villa' }}</p>
                                    <p class="text-xs text-gray-500">{{ $property->location ?? 'Beverly Hills' }}</p>
                                    <p class="text-sm font-bold text-indigo-600 mt-1">${{ number_format($property->price ?? 450000, 0) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="px-6 py-3 border-t border-gray-200">
                    <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                        View All Matches <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>

            <!-- Lead Tags -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags ?? ['Hot Lead', 'Qualified', 'High Budget', 'Urgent'] as $tag)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            {{ $tag }}
                            <button class="ml-1 text-indigo-600 hover:text-indigo-800">×</button>
                        </span>
                    @endforeach
                </div>
                <button class="mt-3 text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                    <i class="fas fa-plus mr-1"></i> Add Tag
                </button>
            </div>

            <!-- Danger Zone -->
            <div class="bg-white rounded-lg shadow border border-red-200 p-6">
                <h3 class="font-semibold text-red-900 mb-4">Danger Zone</h3>
                <div class="space-y-3">
                    <button class="w-full bg-white border border-red-300 hover:bg-red-50 text-red-700 px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-archive mr-2"></i> Archive Lead
                    </button>
                    <button class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-trash mr-2"></i> Delete Lead
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
