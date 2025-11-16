@extends('layouts.app')

@section('title', 'Leads Management')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-user-plus mr-2 text-indigo-600"></i>
                Leads Management
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Manage and track all your leads
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-filter mr-2"></i>
                Filters
            </button>
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-download mr-2"></i>
                Export
            </button>
            <button onclick="window.location.href='{{ route('agency.leads.create') }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add Lead
            </button>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="grid grid-cols-2 md:grid-cols-7 gap-4 text-center">
            <div class="p-2 cursor-pointer hover:bg-gray-50 rounded" onclick="filterLeads('all')">
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] ?? 156 }}</p>
                <p class="text-xs text-gray-600">Total</p>
            </div>
            <div class="p-2 cursor-pointer hover:bg-blue-50 rounded" onclick="filterLeads('new')">
                <p class="text-2xl font-bold text-blue-900">{{ $stats['new'] ?? 32 }}</p>
                <p class="text-xs text-blue-600">New</p>
            </div>
            <div class="p-2 cursor-pointer hover:bg-indigo-50 rounded" onclick="filterLeads('contacted')">
                <p class="text-2xl font-bold text-indigo-900">{{ $stats['contacted'] ?? 28 }}</p>
                <p class="text-xs text-indigo-600">Contacted</p>
            </div>
            <div class="p-2 cursor-pointer hover:bg-purple-50 rounded" onclick="filterLeads('qualified')">
                <p class="text-2xl font-bold text-purple-900">{{ $stats['qualified'] ?? 24 }}</p>
                <p class="text-xs text-purple-600">Qualified</p>
            </div>
            <div class="p-2 cursor-pointer hover:bg-yellow-50 rounded" onclick="filterLeads('proposal')">
                <p class="text-2xl font-bold text-yellow-900">{{ $stats['proposal'] ?? 18 }}</p>
                <p class="text-xs text-yellow-600">Proposal</p>
            </div>
            <div class="p-2 cursor-pointer hover:bg-green-50 rounded" onclick="filterLeads('won')">
                <p class="text-2xl font-bold text-green-900">{{ $stats['won'] ?? 22 }}</p>
                <p class="text-xs text-green-600">Won</p>
            </div>
            <div class="p-2 cursor-pointer hover:bg-red-50 rounded" onclick="filterLeads('lost')">
                <p class="text-2xl font-bold text-red-900">{{ $stats['lost'] ?? 17 }}</p>
                <p class="text-xs text-red-600">Lost</p>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" placeholder="Search leads..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option>All Statuses</option>
                    <option>New</option>
                    <option>Contacted</option>
                    <option>Qualified</option>
                    <option>Proposal</option>
                    <option>Negotiation</option>
                    <option>Won</option>
                    <option>Lost</option>
                </select>
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option>All Priorities</option>
                    <option>High</option>
                    <option>Medium</option>
                    <option>Low</option>
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

    <!-- Leads Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lead
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Source
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Priority
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Assigned To
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Budget
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Last Contact
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($leads ?? [] as $lead)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-indigo-100 rounded-full h-10 w-10 flex items-center justify-center text-indigo-600 font-bold">
                                        {{ substr($lead->name ?? 'L', 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $lead->name ?? 'John Doe' }}</div>
                                        <div class="text-sm text-gray-500">ID: #{{ $lead->id ?? '001' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $lead->email ?? 'john@example.com' }}</div>
                                <div class="text-sm text-gray-500">{{ $lead->phone ?? '+1234567890' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-{{ $lead->source_icon ?? 'globe' }} mr-1"></i>
                                    {{ ucfirst($lead->source ?? 'website') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select class="text-xs rounded-full px-2.5 py-0.5 font-medium border-0 bg-{{ $lead->status_color ?? 'gray' }}-100 text-{{ $lead->status_color ?? 'gray' }}-800 focus:ring-2 focus:ring-{{ $lead->status_color ?? 'gray' }}-500">
                                    <option value="new" {{ ($lead->status ?? 'new') == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="contacted" {{ ($lead->status ?? '') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                    <option value="qualified" {{ ($lead->status ?? '') == 'qualified' ? 'selected' : '' }}>Qualified</option>
                                    <option value="proposal" {{ ($lead->status ?? '') == 'proposal' ? 'selected' : '' }}>Proposal</option>
                                    <option value="negotiation" {{ ($lead->status ?? '') == 'negotiation' ? 'selected' : '' }}>Negotiation</option>
                                    <option value="won" {{ ($lead->status ?? '') == 'won' ? 'selected' : '' }}>Won</option>
                                    <option value="lost" {{ ($lead->status ?? '') == 'lost' ? 'selected' : '' }}>Lost</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ ($lead->priority ?? 'medium') == 'high' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ ($lead->priority ?? 'medium') == 'medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ ($lead->priority ?? 'medium') == 'low' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ ucfirst($lead->priority ?? 'medium') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($lead->assigned_to ?? null)
                                        <img class="h-6 w-6 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($lead->realtor_name ?? 'Unassigned') }}" alt="">
                                        <span class="ml-2 text-sm text-gray-900">{{ $lead->realtor_name ?? 'Unassigned' }}</span>
                                    @else
                                        <span class="text-sm text-gray-500">Unassigned</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($lead->budget ?? null)
                                    ${{ number_format($lead->budget, 0) }}
                                @else
                                    <span class="text-gray-400">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $lead->last_contacted_at ?? '2 days ago' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button onclick="window.location.href='{{ route('agency.leads.show', $lead->id ?? 1) }}'" class="text-indigo-600 hover:text-indigo-900" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="window.location.href='{{ route('agency.leads.edit', $lead->id ?? 1) }}'" class="text-blue-600 hover:text-blue-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-900" title="Convert to Client">
                                        <i class="fas fa-user-check"></i>
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
                                    <i class="fas fa-user-plus text-gray-300 text-5xl mb-4"></i>
                                    <p class="text-gray-500 text-lg font-medium">No leads found</p>
                                    <p class="text-gray-400 text-sm mt-1">Start by adding your first lead</p>
                                    <button onclick="window.location.href='{{ route('agency.leads.create') }}'" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md">
                                        <i class="fas fa-plus mr-2"></i>Add First Lead
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Previous
                </a>
                <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Next
                </a>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of{' '}
                        <span class="font-medium">{{ $stats['total'] ?? 156 }}</span> results
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-indigo-50 text-sm font-medium text-indigo-600">2</a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function filterLeads(status) {
    // Add filter functionality here
    console.log('Filtering by:', status);
}
</script>
@endpush
@endsection
