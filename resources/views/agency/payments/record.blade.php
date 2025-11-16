@extends('layouts.app')

@section('title', 'Record Payment')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <button onclick="window.history.back()" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left text-xl"></i>
            </button>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    <i class="fas fa-dollar-sign mr-2 text-green-600"></i>
                    Record Payment
                </h1>
                <p class="mt-1 text-sm text-gray-600">
                    Record client payment and auto-generate receipt
                </p>
            </div>
        </div>
    </div>

    <!-- Payment Form -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-50">
            <h2 class="text-lg font-semibold text-gray-900">Payment Information</h2>
        </div>

        <form class="p-6 space-y-6">
            <!-- Property & Client Selection -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Property <span class="text-red-500">*</span>
                    </label>
                    <select required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                        <option value="">Select Property</option>
                        @foreach($properties ?? [] as $property)
                            <option value="{{ $property->id }}">
                                {{ $property->title }} - ${{ number_format($property->price, 0) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Client <span class="text-red-500">*</span>
                    </label>
                    <select required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                        <option value="">Select Client</option>
                        @foreach($clients ?? [] as $client)
                            <option value="{{ $client->id }}">{{ $client->name }} - {{ $client->reference }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Details</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Payment Milestone <span class="text-red-500">*</span>
                        </label>
                        <select required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                            <option value="">Select Milestone</option>
                            <option value="initial_deposit">Initial Deposit (10%)</option>
                            <option value="survey_fee">Survey Fee</option>
                            <option value="documentation_fee">Documentation Fee</option>
                            <option value="monthly_payment">Monthly Payment</option>
                            <option value="allocation_fee">Allocation Fee</option>
                            <option value="final_balance">Final Balance</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Amount Paid <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500 text-lg">$</span>
                            <input type="number" step="0.01" required placeholder="0.00" class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Payment Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" required value="{{ date('Y-m-d') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Payment Method <span class="text-red-500">*</span>
                        </label>
                        <select required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                            <option value="">Select Method</option>
                            <option value="cash">Cash</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="check">Check</option>
                            <option value="card">Credit/Debit Card</option>
                            <option value="online">Online Payment</option>
                            <option value="paystack">Paystack</option>
                            <option value="stripe">Stripe</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Reference/Transaction ID
                        </label>
                        <input type="text" placeholder="e.g., TRF123456789" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Payment Notes
                        </label>
                        <textarea rows="3" placeholder="Additional payment notes or comments..." class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>
                </div>
            </div>

            <!-- Auto-Actions -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Automated Actions</h3>

                <div class="space-y-3 bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-blue-600 mt-0.5 mr-3"></i>
                        <div>
                            <p class="text-sm font-medium text-blue-900">Auto-Generate Receipt</p>
                            <p class="text-xs text-blue-700">System will automatically generate a PDF receipt with payment details</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-blue-600 mt-0.5 mr-3"></i>
                        <div>
                            <p class="text-sm font-medium text-blue-900">Send Notification</p>
                            <p class="text-xs text-blue-700">Client and assigned realtor will be notified via email and SMS</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-blue-600 mt-0.5 mr-3"></i>
                        <div>
                            <p class="text-sm font-medium text-blue-900">Update Payment Schedule</p>
                            <p class="text-xs text-blue-700">Payment schedule will be updated and next payment calculated</p>
                        </div>
                    </div>
                    <div class="flex items-start" id="lock-property-info">
                        <i class="fas fa-lock text-blue-600 mt-0.5 mr-3"></i>
                        <div>
                            <p class="text-sm font-medium text-blue-900">Lock Property (Initial Deposit)</p>
                            <p class="text-xs text-blue-700">Property will be locked for this client once initial deposit is confirmed</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Receipt Preview Options -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Receipt Options</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" checked class="h-4 w-4 text-green-600 rounded">
                        <span class="ml-3 text-sm text-gray-700">Email receipt to client</span>
                    </label>

                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" checked class="h-4 w-4 text-green-600 rounded">
                        <span class="ml-3 text-sm text-gray-700">Email receipt to realtor</span>
                    </label>

                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" class="h-4 w-4 text-green-600 rounded">
                        <span class="ml-3 text-sm text-gray-700">SMS notification to client</span>
                    </label>

                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" class="h-4 w-4 text-green-600 rounded">
                        <span class="ml-3 text-sm text-gray-700">Print receipt</span>
                    </label>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="border-t border-gray-200 pt-6 flex justify-between">
                <button type="button" onclick="window.history.back()" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-md font-semibold">
                    Cancel
                </button>
                <div class="flex space-x-3">
                    <button type="button" class="bg-white border border-green-600 text-green-600 hover:bg-green-50 px-6 py-3 rounded-md font-semibold">
                        <i class="fas fa-eye mr-2"></i> Preview Receipt
                    </button>
                    <button type="submit" class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-8 py-3 rounded-md font-semibold shadow-lg">
                        <i class="fas fa-check-circle mr-2"></i> Record Payment & Generate Receipt
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Recent Payments -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-history mr-2 text-gray-600"></i>
                Recent Payments
            </h2>
        </div>
        <div class="divide-y divide-gray-200">
            @foreach($recent_payments ?? [] as $payment)
                <div class="px-6 py-4 hover:bg-gray-50 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $payment->milestone ?? 'Initial Deposit' }} - ${{ number_format($payment->amount ?? 45000, 0) }}</p>
                            <p class="text-xs text-gray-600">{{ $payment->client ?? 'John Doe' }} • {{ $payment->property ?? '4 Bedroom Villa' }}</p>
                            <p class="text-xs text-gray-500">{{ $payment->date ?? 'Nov 5, 2025' }} • {{ $payment->method ?? 'Bank Transfer' }}</p>
                        </div>
                    </div>
                    <button onclick="window.location.href='{{ route('payments.receipt', $payment->id ?? 1) }}'" class="text-green-600 hover:text-green-700 text-sm font-medium">
                        <i class="fas fa-file-invoice mr-1"></i> View Receipt
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
// Show/hide property lock info based on milestone selection
document.querySelector('select[required]')?.addEventListener('change', function(e) {
    const lockInfo = document.getElementById('lock-property-info');
    if (e.target.value === 'initial_deposit') {
        lockInfo?.classList.remove('hidden');
    } else {
        lockInfo?.classList.add('hidden');
    }
});
</script>
@endsection
