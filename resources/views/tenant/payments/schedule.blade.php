@extends('layouts.app')

@section('title', 'Payment Schedule Management')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-calendar-check mr-2 text-green-600"></i>
                Payment Schedule Management
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Manage property payment milestones and auto-generate schedules
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-download mr-2"></i>
                Export Schedules
            </button>
            <button onclick="document.getElementById('create-schedule-modal').classList.remove('hidden')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Create Schedule
            </button>
        </div>
    </div>

    <!-- Property Selector -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Select Property</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option>4 Bedroom Luxury Villa - Beverly Hills</option>
                    @foreach($properties ?? [] as $property)
                        <option value="{{ $property->id }}">{{ $property->title }} - {{ $property->location }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option>John Doe - CLI-2025-001</option>
                    @foreach($clients ?? [] as $client)
                        <option value="{{ $client->id }}">{{ $client->name }} - {{ $client->reference }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Total Property Price</label>
                <input type="text" value="$450,000" readonly class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50 font-bold">
            </div>
        </div>
    </div>

    <!-- Payment Schedule -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-50">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-list-alt mr-2 text-green-600"></i>
                        Payment Milestones & Schedule
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Auto-generated payment plan with milestones</p>
                </div>
                <div class="flex space-x-2">
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-magic mr-2"></i> Auto-Generate
                    </button>
                    <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-save mr-2"></i> Save Schedule
                    </button>
                </div>
            </div>
        </div>

        <div class="p-6">
            <!-- Total Summary -->
            <div class="grid grid-cols-5 gap-4 mb-6">
                <div class="bg-gray-50 rounded-lg p-4 text-center">
                    <p class="text-sm text-gray-600">Total Price</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($schedule->total ?? 450000, 0) }}</p>
                </div>
                <div class="bg-green-50 rounded-lg p-4 text-center">
                    <p class="text-sm text-green-600">Total Paid</p>
                    <p class="text-2xl font-bold text-green-900">${{ number_format($schedule->paid ?? 45000, 0) }}</p>
                </div>
                <div class="bg-orange-50 rounded-lg p-4 text-center">
                    <p class="text-sm text-orange-600">Balance</p>
                    <p class="text-2xl font-bold text-orange-900">${{ number_format(($schedule->total ?? 450000) - ($schedule->paid ?? 45000), 0) }}</p>
                </div>
                <div class="bg-blue-50 rounded-lg p-4 text-center">
                    <p class="text-sm text-blue-600">Next Payment</p>
                    <p class="text-2xl font-bold text-blue-900">${{ number_format($schedule->next_payment ?? 10000, 0) }}</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-4 text-center">
                    <p class="text-sm text-purple-600">Due Date</p>
                    <p class="text-lg font-bold text-purple-900">{{ $schedule->next_due ?? 'Dec 1, 2025' }}</p>
                </div>
            </div>

            <!-- Payment Milestones Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Milestone</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paid Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Receipt</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach([
                            ['name' => 'Initial Deposit', 'description' => '10% of purchase price', 'amount' => 45000, 'percentage' => 10, 'due' => 'Nov 5, 2025', 'status' => 'paid', 'paid_date' => 'Nov 5, 2025'],
                            ['name' => 'Survey Fee', 'description' => 'Property survey and inspection', 'amount' => 2500, 'percentage' => null, 'due' => 'Nov 10, 2025', 'status' => 'paid', 'paid_date' => 'Nov 10, 2025'],
                            ['name' => 'Documentation Fee', 'description' => 'Legal and processing fees', 'amount' => 3500, 'percentage' => null, 'due' => 'Nov 15, 2025', 'status' => 'paid', 'paid_date' => 'Nov 15, 2025'],
                            ['name' => 'Monthly Payment #1', 'description' => 'Monthly installment', 'amount' => 10000, 'percentage' => null, 'due' => 'Dec 1, 2025', 'status' => 'pending', 'paid_date' => null],
                            ['name' => 'Monthly Payment #2', 'description' => 'Monthly installment', 'amount' => 10000, 'percentage' => null, 'due' => 'Jan 1, 2026', 'status' => 'pending', 'paid_date' => null],
                            ['name' => 'Allocation Fee', 'description' => 'Property allocation processing', 'amount' => 5000, 'percentage' => null, 'due' => 'Feb 1, 2026', 'status' => 'pending', 'paid_date' => null],
                            ['name' => 'Final Balance', 'description' => 'Remaining balance payment', 'amount' => 374000, 'percentage' => 83.11, 'due' => 'Dec 15, 2025', 'status' => 'pending', 'paid_date' => null],
                        ] as $milestone)
                            <tr class="hover:bg-gray-50 {{ $milestone['status'] === 'paid' ? 'bg-green-50' : '' }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($milestone['status'] === 'paid')
                                            <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                                        @elseif($milestone['status'] === 'overdue')
                                            <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
                                        @else
                                            <i class="fas fa-circle text-gray-400 text-xl mr-3"></i>
                                        @endif
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">{{ $milestone['name'] }}</p>
                                            @if($milestone['percentage'])
                                                <p class="text-xs text-gray-500">{{ $milestone['percentage'] }}% of total</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $milestone['description'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    ${{ number_format($milestone['amount'], 0) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $milestone['due'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $milestone['status'] === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $milestone['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $milestone['status'] === 'overdue' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($milestone['status']) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $milestone['paid_date'] ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($milestone['status'] === 'paid')
                                        <button class="text-green-600 hover:text-green-700 text-sm font-medium">
                                            <i class="fas fa-file-invoice mr-1"></i> View
                                        </button>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($milestone['status'] === 'paid')
                                        <button class="text-indigo-600 hover:text-indigo-700 mr-2" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    @else
                                        <button onclick="openRecordPaymentModal({{ json_encode($milestone) }})" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-medium">
                                            <i class="fas fa-dollar-sign mr-1"></i> Record Payment
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Add Milestone Button -->
            <div class="mt-6 flex justify-center">
                <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-md">
                    <i class="fas fa-plus mr-2"></i> Add Custom Milestone
                </button>
            </div>
        </div>
    </div>

    <!-- Notification Settings -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            <i class="fas fa-bell mr-2 text-blue-600"></i>
            Automatic Reminders & Notifications
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-medium text-gray-900 mb-3">Client Notifications</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-green-600 rounded">
                        <span class="ml-2 text-sm text-gray-700">7 days before due date</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-green-600 rounded">
                        <span class="ml-2 text-sm text-gray-700">3 days before due date</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-green-600 rounded">
                        <span class="ml-2 text-sm text-gray-700">1 day before due date</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-green-600 rounded">
                        <span class="ml-2 text-sm text-gray-700">On due date</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-green-600 rounded">
                        <span class="ml-2 text-sm text-gray-700">Payment confirmation</span>
                    </label>
                </div>
            </div>
            <div>
                <h3 class="font-medium text-gray-900 mb-3">Realtor Notifications</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-green-600 rounded">
                        <span class="ml-2 text-sm text-gray-700">When payment is received</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-green-600 rounded">
                        <span class="ml-2 text-sm text-gray-700">When payment is overdue</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-green-600 rounded">
                        <span class="ml-2 text-sm text-gray-700">When property is fully paid</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-green-600 rounded">
                        <span class="ml-2 text-sm text-gray-700">Daily payment summary</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="mt-6">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md">
                <i class="fas fa-save mr-2"></i> Save Notification Settings
            </button>
        </div>
    </div>

    <!-- Property Lock Status -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            <i class="fas fa-lock mr-2 text-purple-600"></i>
            Property Lock Status
        </h2>
        <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center space-x-4">
                <div class="h-12 w-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-lock text-green-600 text-xl"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Property Locked for Client</p>
                    <p class="text-sm text-gray-600">Initial deposit confirmed on Nov 5, 2025</p>
                </div>
            </div>
            <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm">
                <i class="fas fa-unlock mr-2"></i> Unlock Property
            </button>
        </div>
        <p class="text-xs text-gray-500 mt-3">
            <i class="fas fa-info-circle mr-1"></i>
            Property will automatically lock when initial deposit is confirmed. Unlock only if deal is cancelled.
        </p>
    </div>
</div>

<!-- Create Schedule Modal -->
<div id="create-schedule-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-magic mr-2 text-green-600"></i>
                    Auto-Generate Payment Schedule
                </h2>
                <button onclick="document.getElementById('create-schedule-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
        </div>

        <div class="p-6">
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Property</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md">
                        <option>Select Property</option>
                        @foreach($properties ?? [] as $property)
                            <option value="{{ $property->id }}">{{ $property->title }} - ${{ number_format($property->price, 0) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md">
                        <option>Select Client</option>
                        @foreach($clients ?? [] as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Initial Deposit %</label>
                        <input type="number" value="10" min="0" max="100" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Payment Period (Months)</label>
                        <input type="number" value="12" min="1" max="120" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Additional Fees</label>
                    <div class="space-y-2">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" placeholder="Survey Fee" value="Survey Fee" readonly class="px-4 py-2 border border-gray-300 rounded-md bg-gray-50">
                            <input type="number" placeholder="Amount" value="2500" class="px-4 py-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" placeholder="Documentation Fee" value="Documentation Fee" readonly class="px-4 py-2 border border-gray-300 rounded-md bg-gray-50">
                            <input type="number" placeholder="Amount" value="3500" class="px-4 py-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" placeholder="Allocation Fee" value="Allocation Fee" readonly class="px-4 py-2 border border-gray-300 rounded-md bg-gray-50">
                            <input type="number" placeholder="Amount" value="5000" class="px-4 py-2 border border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Payment Date</label>
                    <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md font-semibold">
                        <i class="fas fa-magic mr-2"></i> Generate Schedule
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openRecordPaymentModal(milestone) {
    alert('Recording payment for: ' + milestone.name + ' - $' + milestone.amount);
    // This would open a payment recording modal
}
</script>
@endsection
