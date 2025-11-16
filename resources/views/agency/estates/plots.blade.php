@extends('layouts.app')

@section('title', 'Plot Management')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <button onclick="window.history.back()" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left text-xl"></i>
            </button>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    <i class="fas fa-th mr-2 text-purple-600"></i>
                    {{ $estate->name ?? 'Sunset Gardens Estate' }} - Plots
                </h1>
                <p class="mt-1 text-sm text-gray-600">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    {{ $estate->location ?? 'Lekki, Lagos' }}
                </p>
            </div>
        </div>
        <div class="flex space-x-3">
            <button onclick="toggleView()" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md" id="view-toggle">
                <i class="fas fa-map mr-2"></i> Map View
            </button>
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                <i class="fas fa-user-plus mr-2"></i> Allocate Plot
            </button>
        </div>
    </div>

    <!-- Inventory Summary -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg shadow-lg p-6 text-white">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div class="text-center">
                <p class="text-sm opacity-90">Total Plots</p>
                <p class="text-4xl font-bold">{{ number_format($estate->total_plots ?? 500) }}</p>
            </div>
            <div class="text-center">
                <p class="text-sm opacity-90">Available</p>
                <p class="text-4xl font-bold text-green-300">{{ number_format($inventory->available ?? 342) }}</p>
            </div>
            <div class="text-center">
                <p class="text-sm opacity-90">Reserved</p>
                <p class="text-4xl font-bold text-yellow-300">{{ number_format($inventory->reserved ?? 78) }}</p>
            </div>
            <div class="text-center">
                <p class="text-sm opacity-90">Allocated</p>
                <p class="text-4xl font-bold text-blue-300">{{ number_format($inventory->allocated ?? 80) }}</p>
            </div>
            <div class="text-center">
                <p class="text-sm opacity-90">Remaining %</p>
                <p class="text-4xl font-bold {{ ($inventory->available_percentage ?? 68.4) <= 20 ? 'text-red-300' : 'text-green-300' }}">
                    {{ number_format($inventory->available_percentage ?? 68.4, 1) }}%
                </p>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="md:col-span-2">
                <input type="text" placeholder="Search by plot number, client name..." class="w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option>All Statuses</option>
                    <option value="available">Available</option>
                    <option value="reserved">Reserved</option>
                    <option value="allocated">Allocated</option>
                </select>
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    @if($estate->phases_count ?? 0)
                        <option>All Phases</option>
                        @foreach($phases ?? [] as $phase)
                            <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                        @endforeach
                    @else
                        <option>No Phases</option>
                    @endif
                </select>
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option>Sort: Plot Number</option>
                    <option>Sort: Status</option>
                    <option>Sort: Price</option>
                    <option>Sort: Client Name</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Grid View -->
    <div id="grid-view" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-4">
        @for($i = 1; $i <= ($estate->total_plots ?? 500); $i++)
            @php
                $status = $i <= 80 ? 'allocated' : ($i <= 158 ? 'reserved' : 'available');
                $client = $status === 'allocated' ? 'John Doe' : ($status === 'reserved' ? 'Jane Smith' : null);
            @endphp

            <div class="relative group cursor-pointer transform hover:scale-105 transition" onclick="showPlotDetails({{ $i }}, '{{ $status }}', '{{ $client }}')">
                <!-- Plot Card -->
                <div class="border-2 rounded-lg p-4 text-center
                    {{ $status === 'available' ? 'border-green-300 bg-green-50 hover:border-green-500' : '' }}
                    {{ $status === 'reserved' ? 'border-yellow-300 bg-yellow-50 hover:border-yellow-500' : '' }}
                    {{ $status === 'allocated' ? 'border-indigo-300 bg-indigo-50 hover:border-indigo-500' : '' }}">

                    <!-- Plot Number -->
                    <p class="text-2xl font-bold {{ $status === 'available' ? 'text-green-900' : ($status === 'reserved' ? 'text-yellow-900' : 'text-indigo-900') }}">
                        {{ str_pad($i, 3, '0', STR_PAD_LEFT) }}
                    </p>

                    <!-- Status Icon -->
                    <div class="mt-2">
                        @if($status === 'available')
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        @elseif($status === 'reserved')
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        @else
                            <i class="fas fa-user-check text-indigo-600 text-xl"></i>
                        @endif
                    </div>

                    <!-- Status Label -->
                    <p class="text-xs mt-2 font-medium {{ $status === 'available' ? 'text-green-700' : ($status === 'reserved' ? 'text-yellow-700' : 'text-indigo-700') }}">
                        {{ ucfirst($status) }}
                    </p>

                    <!-- Client Name (if allocated/reserved) -->
                    @if($client)
                        <p class="text-xs text-gray-600 mt-1 truncate">{{ $client }}</p>
                    @endif
                </div>

                <!-- Hover Tooltip -->
                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block z-10">
                    <div class="bg-gray-900 text-white text-xs rounded-lg py-2 px-3 whitespace-nowrap shadow-lg">
                        <p class="font-medium">Plot #{{ $i }}</p>
                        @if($client)
                            <p class="text-gray-300">{{ $client }}</p>
                        @endif
                        <p class="text-gray-400">${{ number_format($estate->price_per_plot ?? 25000, 0) }}</p>
                    </div>
                </div>
            </div>
        @endfor
    </div>

    <!-- Map View (Hidden by default) -->
    <div id="map-view" class="hidden bg-white rounded-lg shadow-lg p-6">
        <div class="bg-gray-200 rounded-lg flex items-center justify-center" style="min-height: 600px;">
            @if($estate->site_map ?? null)
                <img src="{{ $estate->site_map }}" alt="Estate Site Map" class="max-w-full max-h-full object-contain">
            @else
                <div class="text-center">
                    <i class="fas fa-map text-gray-400 text-6xl mb-4"></i>
                    <p class="text-gray-600 font-medium">No site map uploaded</p>
                    <p class="text-gray-500 text-sm mt-2">Upload estate layout in settings to enable interactive map view</p>
                    <button class="mt-4 bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-md">
                        Upload Site Map
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Legend -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-gray-900 mb-4">Legend</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 border-2 border-green-500 bg-green-100 rounded flex items-center justify-center">
                    <i class="fas fa-check text-green-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900">Available</p>
                    <p class="text-xs text-gray-600">{{ number_format($inventory->available ?? 342) }} plots</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 border-2 border-yellow-500 bg-yellow-100 rounded flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900">Reserved</p>
                    <p class="text-xs text-gray-600">{{ number_format($inventory->reserved ?? 78) }} plots</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 border-2 border-indigo-500 bg-indigo-100 rounded flex items-center justify-center">
                    <i class="fas fa-user-check text-indigo-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900">Allocated</p>
                    <p class="text-xs text-gray-600">{{ number_format($inventory->allocated ?? 80) }} plots</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 border-2 border-red-500 bg-red-100 rounded flex items-center justify-center">
                    <i class="fas fa-ban text-red-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900">Unavailable</p>
                    <p class="text-xs text-gray-600">Not for sale</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Plot Details Modal -->
<div id="plot-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-map-pin mr-2 text-purple-600"></i>
                Plot <span id="modal-plot-number"></span>
            </h2>
            <button onclick="closePlotModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <div class="p-6" id="modal-content">
            <!-- Content will be dynamically loaded -->
        </div>
    </div>
</div>

<script>
function toggleView() {
    const gridView = document.getElementById('grid-view');
    const mapView = document.getElementById('map-view');
    const toggleBtn = document.getElementById('view-toggle');

    if (gridView.classList.contains('hidden')) {
        gridView.classList.remove('hidden');
        mapView.classList.add('hidden');
        toggleBtn.innerHTML = '<i class="fas fa-map mr-2"></i> Map View';
    } else {
        gridView.classList.add('hidden');
        mapView.classList.remove('hidden');
        toggleBtn.innerHTML = '<i class="fas fa-th mr-2"></i> Grid View';
    }
}

function showPlotDetails(plotNumber, status, client) {
    const modal = document.getElementById('plot-modal');
    const modalPlotNumber = document.getElementById('modal-plot-number');
    const modalContent = document.getElementById('modal-content');

    modalPlotNumber.textContent = plotNumber.toString().padStart(3, '0');

    // Generate content based on status
    let content = `
        <div class="space-y-6">
            <div class="bg-${status === 'available' ? 'green' : (status === 'reserved' ? 'yellow' : 'indigo')}-50 border border-${status === 'available' ? 'green' : (status === 'reserved' ? 'yellow' : 'indigo')}-200 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <p class="text-2xl font-bold text-gray-900">${status.charAt(0).toUpperCase() + status.slice(1)}</p>
                    </div>
                    <i class="fas fa-${status === 'available' ? 'check-circle' : (status === 'reserved' ? 'clock' : 'user-check')} text-5xl text-${status === 'available' ? 'green' : (status === 'reserved' ? 'yellow' : 'indigo')}-600"></i>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Plot Number</p>
                    <p class="text-lg font-bold text-gray-900">${plotNumber.toString().padStart(3, '0')}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Price</p>
                    <p class="text-lg font-bold text-purple-600">$${({{ $estate->price_per_plot ?? 25000 }}).toLocaleString()}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Size</p>
                    <p class="text-lg font-bold text-gray-900">600 sqm</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Phase</p>
                    <p class="text-lg font-bold text-gray-900">Phase 1</p>
                </div>
            </div>

            ${client ? `
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Client Information</h3>
                    <div class="flex items-center space-x-4 mb-4">
                        <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(client)}" class="h-12 w-12 rounded-full" alt="">
                        <div>
                            <p class="font-semibold text-gray-900">${client}</p>
                            <p class="text-sm text-gray-600">${status === 'allocated' ? 'Full Payment Completed' : 'Partial Payment (Reserved)'}</p>
                        </div>
                    </div>
                    <button onclick="window.location.href='#'" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                        View Client Details <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
            ` : ''}

            <div class="flex space-x-3">
                ${status === 'available' ? `
                    <button onclick="window.location.href='{{ route('agency.estates.allocate', $estate->id ?? 1) }}?plot=${plotNumber}'" class="flex-1 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md font-semibold">
                        <i class="fas fa-user-plus mr-2"></i> Allocate to Client
                    </button>
                ` : ''}
                ${status === 'reserved' ? `
                    <button class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-md font-semibold">
                        <i class="fas fa-hand-holding-usd mr-2"></i> Complete Payment
                    </button>
                    <button class="flex-1 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-md font-semibold">
                        <i class="fas fa-times mr-2"></i> Release Plot
                    </button>
                ` : ''}
            </div>
        </div>
    `;

    modalContent.innerHTML = content;
    modal.classList.remove('hidden');
}

function closePlotModal() {
    document.getElementById('plot-modal').classList.add('hidden');
}
</script>
@endsection
