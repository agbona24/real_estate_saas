@extends('layouts.app')

@section('title', 'My Commissions & Earnings')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-dollar-sign mr-2 text-green-600"></i>
                My Commissions & Earnings
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Track your performance and earnings
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-download mr-2"></i>
                Download Report
            </button>
        </div>
    </div>

    <!-- Earnings Overview -->
    <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg shadow-xl p-8 text-white">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <p class="text-green-100 text-sm mb-2">Total Lifetime Earnings</p>
                <p class="text-5xl font-bold mb-2">${{ number_format($lifetime_earnings ?? 156000, 0) }}</p>
                <p class="text-sm text-green-100">Since {{ $start_date ?? 'Jan 2024' }}</p>
            </div>
            <div>
                <p class="text-green-100 text-sm mb-2">This Month</p>
                <p class="text-5xl font-bold mb-2">${{ number_format($monthly_earnings ?? 8500, 0) }}</p>
                <p class="text-sm text-green-100">
                    <i class="fas fa-arrow-up mr-1"></i>
                    {{ $growth_percentage ?? 15 }}% from last month
                </p>
            </div>
            <div>
                <p class="text-green-100 text-sm mb-2">Pending Payout</p>
                <p class="text-5xl font-bold mb-2">${{ number_format($pending_payout ?? 2100, 0) }}</p>
                <p class="text-sm text-green-100">Next payout on {{ $next_payout_date ?? 'Dec 1' }}</p>
            </div>
        </div>
    </div>

    <!-- Performance Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm font-medium text-gray-600">Deals Closed</p>
                <i class="fas fa-handshake text-blue-500 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $deals_closed ?? 28 }}</p>
            <p class="text-sm text-gray-500 mt-1">This year</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm font-medium text-gray-600">Avg. Commission</p>
                <i class="fas fa-chart-line text-green-500 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-gray-900">${{ number_format($avg_commission ?? 5571, 0) }}</p>
            <p class="text-sm text-gray-500 mt-1">Per deal</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm font-medium text-gray-600">Conversion Rate</p>
                <i class="fas fa-percentage text-purple-500 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $conversion_rate ?? 32 }}%</p>
            <p class="text-sm text-gray-500 mt-1">Lead to client</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm font-medium text-gray-600">Avg. Deal Size</p>
                <i class="fas fa-home text-yellow-500 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-gray-900">${{ number_format($avg_deal_size ?? 385000, 0) }}</p>
            <p class="text-sm text-gray-500 mt-1">Property value</p>
        </div>
    </div>

    <!-- Monthly Earnings Chart -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-chart-area mr-2 text-gray-600"></i>
                Earnings Trend (Last 6 Months)
            </h2>
        </div>
        <div class="p-6">
            <canvas id="earningsChart" height="100"></canvas>
        </div>
    </div>

    <!-- Recent Commissions -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-list mr-2 text-gray-600"></i>
                Recent Commissions
            </h2>
            <select class="text-sm border border-gray-300 rounded-md px-3 py-1">
                <option>All Time</option>
                <option>This Month</option>
                <option>Last Month</option>
                <option>This Quarter</option>
                <option>This Year</option>
            </select>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Property</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deal Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Property Value</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commission Rate</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commission</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($commissions ?? [] as $commission)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $commission->date ?? 'Nov 15, 2025' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $commission->property_title ?? 'Luxury Villa' }}</div>
                                <div class="text-sm text-gray-500">{{ $commission->property_location ?? 'Beverly Hills, CA' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $commission->client_name ?? 'John Doe' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ ($commission->type ?? 'sale') === 'sale' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ ucfirst($commission->type ?? 'sale') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                ${{ number_format($commission->property_value ?? 450000, 0) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $commission->rate ?? 3 }}%
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">
                                ${{ number_format($commission->amount ?? 13500, 0) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ ($commission->status ?? 'paid') === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ ($commission->status ?? '') === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ ($commission->status ?? '') === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}">
                                    <i class="fas fa-{{ ($commission->status ?? 'paid') === 'paid' ? 'check-circle' : 'clock' }} mr-1"></i>
                                    {{ ucfirst($commission->status ?? 'paid') }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <i class="fas fa-money-bill-wave text-gray-300 text-5xl mb-4"></i>
                                <p class="text-gray-500 text-lg font-medium">No commissions yet</p>
                                <p class="text-gray-400 text-sm mt-1">Close your first deal to start earning</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Payout History -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-wallet mr-2 text-gray-600"></i>
                Payout History
            </h2>
        </div>
        <div class="p-6">
            <div class="space-y-3">
                @forelse($payouts ?? [] as $payout)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="flex items-center">
                            <div class="bg-green-100 rounded-full h-12 w-12 flex items-center justify-center mr-4">
                                <i class="fas fa-check text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $payout->month ?? 'November 2025' }}</p>
                                <p class="text-sm text-gray-500">{{ $payout->deals_count ?? 3 }} deals • Paid on {{ $payout->date ?? 'Dec 1, 2025' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-green-600">${{ number_format($payout->amount ?? 8500, 0) }}</p>
                            <button class="text-xs text-indigo-600 hover:text-indigo-700 mt-1">
                                <i class="fas fa-file-invoice mr-1"></i> View Details
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No payout history yet</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Earnings Trend Chart
    const ctx = document.getElementById('earningsChart').getContext('2d');
    const earningsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],
            datasets: [{
                label: 'Earnings ($)',
                data: [5200, 6100, 4800, 7300, 6900, 8500],
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
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
