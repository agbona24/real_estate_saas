@extends('layouts.app')

@section('title', 'Estate Inventory Management')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-map-marked-alt mr-2 text-purple-600"></i>
                Estate Inventory Management
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Manage estates, track plot inventory, and prevent over-allocation
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-download mr-2"></i>
                Export Report
            </button>
            <button onclick="window.location.href='{{ route('agency.estates.create') }}'" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Register New Estate
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Estates</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_estates'] ?? 12 }}</p>
                </div>
                <i class="fas fa-city text-purple-500 text-3xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Plots</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_plots'] ?? 2450) }}</p>
                </div>
                <i class="fas fa-th text-blue-500 text-3xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Available</p>
                    <p class="text-3xl font-bold text-green-900">{{ number_format($stats['available_plots'] ?? 1823) }}</p>
                </div>
                <i class="fas fa-check-circle text-green-500 text-3xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Reserved</p>
                    <p class="text-3xl font-bold text-yellow-900">{{ number_format($stats['reserved_plots'] ?? 234) }}</p>
                </div>
                <i class="fas fa-clock text-yellow-500 text-3xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Allocated</p>
                    <p class="text-3xl font-bold text-indigo-900">{{ number_format($stats['allocated_plots'] ?? 393) }}</p>
                </div>
                <i class="fas fa-user-check text-indigo-500 text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- Low Stock Alerts -->
    @if(($low_stock_estates ?? []))
        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl mt-0.5 mr-3"></i>
                <div class="flex-1">
                    <h3 class="text-sm font-medium text-red-900">Low Stock Alert!</h3>
                    <p class="text-sm text-red-700 mt-1">
                        {{ count($low_stock_estates) }} estate(s) running low on available plots
                    </p>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach($low_stock_estates as $estate)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                {{ $estate->name }} - {{ $estate->available_percentage }}% remaining
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Estates Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($estates ?? [] as $estate)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition cursor-pointer" onclick="window.location.href='{{ route('agency.estates.show', $estate->id ?? 1) }}'">
                <!-- Estate Image -->
                <div class="relative h-48 bg-gradient-to-br from-purple-400 to-indigo-600">
                    @if($estate->site_map ?? null)
                        <img src="{{ $estate->site_map }}" alt="Estate Layout" class="w-full h-full object-cover">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-map-marked-alt text-white text-6xl opacity-50"></i>
                        </div>
                    @endif

                    <!-- Status Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium shadow-lg
                            {{ ($estate->status ?? 'active') === 'active' ? 'bg-green-500 text-white' : '' }}
                            {{ ($estate->status ?? '') === 'sold_out' ? 'bg-red-500 text-white' : '' }}
                            {{ ($estate->status ?? '') === 'coming_soon' ? 'bg-yellow-500 text-white' : '' }}">
                            {{ ucfirst(str_replace('_', ' ', $estate->status ?? 'active')) }}
                        </span>
                    </div>

                    <!-- Low Stock Warning -->
                    @if(($estate->available_percentage ?? 100) <= 20)
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-500 text-white shadow-lg animate-pulse">
                                <i class="fas fa-exclamation-triangle mr-1"></i> Low Stock
                            </span>
                        </div>
                    @elseif(($estate->available_percentage ?? 100) <= 50)
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-500 text-white shadow-lg">
                                <i class="fas fa-exclamation-circle mr-1"></i> Running Low
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Estate Info -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $estate->name ?? 'Sunset Gardens Estate' }}</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        {{ $estate->location ?? 'Lekki, Lagos' }}
                    </p>

                    <!-- Plot Stats -->
                    <div class="grid grid-cols-3 gap-3 mb-4">
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($estate->total_plots ?? 500) }}</p>
                            <p class="text-xs text-gray-600">Total Plots</p>
                        </div>
                        <div class="text-center p-3 bg-green-50 rounded-lg">
                            <p class="text-2xl font-bold text-green-900">{{ number_format($estate->available_plots ?? 342) }}</p>
                            <p class="text-xs text-green-600">Available</p>
                        </div>
                        <div class="text-center p-3 bg-indigo-50 rounded-lg">
                            <p class="text-2xl font-bold text-indigo-900">{{ number_format($estate->allocated_plots ?? 158) }}</p>
                            <p class="text-xs text-indigo-600">Sold</p>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex justify-between text-xs text-gray-600 mb-1">
                            <span>Sales Progress</span>
                            <span class="font-medium">{{ number_format(100 - ($estate->available_percentage ?? 68.4), 1) }}% sold</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="h-2.5 rounded-full {{ ($estate->available_percentage ?? 100) <= 20 ? 'bg-red-600' : (($estate->available_percentage ?? 100) <= 50 ? 'bg-yellow-500' : 'bg-green-600') }}"
                                 style="width: {{ 100 - ($estate->available_percentage ?? 68.4) }}%"></div>
                        </div>
                    </div>

                    <!-- Phases Info -->
                    @if($estate->phases_count ?? 0)
                        <div class="mb-4 text-sm text-gray-600">
                            <i class="fas fa-layer-group mr-1"></i>
                            {{ $estate->phases_count }} Phase(s)
                        </div>
                    @endif

                    <!-- Price Range -->
                    <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
                        <div>
                            <p class="text-xs text-gray-500">Price Per Plot</p>
                            <p class="text-lg font-bold text-purple-600">
                                ${{ number_format($estate->price_per_plot ?? 25000, 0) }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Total Value</p>
                            <p class="text-lg font-bold text-gray-900">
                                ${{ number_format(($estate->total_plots ?? 500) * ($estate->price_per_plot ?? 25000) / 1000000, 1) }}M
                            </p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="grid grid-cols-2 gap-2">
                        <button onclick="event.stopPropagation(); window.location.href='{{ route('agency.estates.plots', $estate->id ?? 1) }}'" class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-2 rounded text-sm font-medium">
                            <i class="fas fa-th mr-1"></i> View Plots
                        </button>
                        <button onclick="event.stopPropagation(); window.location.href='{{ route('agency.estates.allocate', $estate->id ?? 1) }}'" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded text-sm font-medium">
                            <i class="fas fa-user-plus mr-1"></i> Allocate
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white rounded-lg shadow p-12 text-center">
                <i class="fas fa-map-marked-alt text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Estates Registered</h3>
                <p class="text-gray-600 mb-6">Start by registering your first estate to manage plot inventory</p>
                <button onclick="window.location.href='{{ route('agency.estates.create') }}'" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-md font-semibold">
                    <i class="fas fa-plus mr-2"></i> Register First Estate
                </button>
            </div>
        @endforelse
    </div>

    <!-- Analytics Chart -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Sales Progress Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Sales Progress by Estate</h2>
            <div class="h-64">
                <canvas id="sales-progress-chart"></canvas>
            </div>
        </div>

        <!-- Inventory Status -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Overall Inventory Status</h2>
            <div class="h-64">
                <canvas id="inventory-chart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-history mr-2 text-gray-600"></i>
                Recent Allocations
            </h2>
        </div>
        <div class="divide-y divide-gray-200">
            @foreach($recent_allocations ?? [] as $allocation)
                <div class="px-6 py-4 hover:bg-gray-50 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-map-pin text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">
                                Plot {{ $allocation->plot_number ?? '145' }} - {{ $allocation->estate_name ?? 'Sunset Gardens' }}
                            </p>
                            <p class="text-xs text-gray-600">
                                Allocated to {{ $allocation->client_name ?? 'John Doe' }} •
                                {{ $allocation->time ?? '2 hours ago' }}
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-purple-600">${{ number_format($allocation->amount ?? 25000, 0) }}</p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                            {{ ucfirst($allocation->status ?? 'allocated') }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Sales Progress Chart
const salesCtx = document.getElementById('sales-progress-chart');
if (salesCtx) {
    new Chart(salesCtx, {
        type: 'bar',
        data: {
            labels: ['Sunset Gardens', 'Paradise Heights', 'Royal Meadows', 'Green Valley', 'Ocean View'],
            datasets: [{
                label: 'Allocated',
                data: [158, 89, 234, 156, 78],
                backgroundColor: 'rgba(147, 51, 234, 0.8)',
            }, {
                label: 'Available',
                data: [342, 211, 266, 344, 172],
                backgroundColor: 'rgba(34, 197, 94, 0.8)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { stacked: true },
                y: { stacked: true, beginAtZero: true }
            }
        }
    });
}

// Inventory Pie Chart
const inventoryCtx = document.getElementById('inventory-chart');
if (inventoryCtx) {
    new Chart(inventoryCtx, {
        type: 'doughnut',
        data: {
            labels: ['Available', 'Reserved', 'Allocated'],
            datasets: [{
                data: [{{ $stats['available_plots'] ?? 1823 }}, {{ $stats['reserved_plots'] ?? 234 }}, {{ $stats['allocated_plots'] ?? 393 }}],
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(234, 179, 8, 0.8)',
                    'rgba(99, 102, 241, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
}
</script>
@endsection
