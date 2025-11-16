@extends('layouts.app')

@section('title', 'Payment Receipt')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <button onclick="window.history.back()" class="text-gray-600 hover:text-gray-900 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </button>
        <div class="flex space-x-3">
            <button onclick="window.print()" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md">
                <i class="fas fa-print mr-2"></i> Print
            </button>
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md">
                <i class="fas fa-download mr-2"></i> Download PDF
            </button>
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                <i class="fas fa-envelope mr-2"></i> Email Receipt
            </button>
        </div>
    </div>

    <!-- Receipt Document -->
    <div id="receipt-document" class="bg-white shadow-2xl" style="width: 8.5in; margin: 0 auto;">
        <!-- Receipt Header -->
        <div class="bg-gradient-to-r from-green-600 to-emerald-600 text-white p-8">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold mb-2">PAYMENT RECEIPT</h1>
                    <p class="text-green-100">Official Payment Confirmation</p>
                </div>
                <div class="text-right">
                    @if($agency->logo ?? null)
                        <img src="{{ $agency->logo }}" alt="Agency Logo" class="h-16 mb-2">
                    @else
                        <div class="bg-white text-green-600 rounded-lg p-4 mb-2">
                            <i class="fas fa-building text-4xl"></i>
                        </div>
                    @endif
                    <p class="text-sm">{{ $agency->name ?? 'Premier Realty' }}</p>
                </div>
            </div>
        </div>

        <!-- Receipt Body -->
        <div class="p-8">
            <!-- Receipt Info -->
            <div class="grid grid-cols-2 gap-8 mb-8">
                <div>
                    <h2 class="text-sm font-semibold text-gray-500 uppercase mb-3">Receipt Information</h2>
                    <div class="space-y-2">
                        <div>
                            <p class="text-xs text-gray-500">Receipt Number</p>
                            <p class="text-sm font-bold text-gray-900 font-mono">{{ $receipt->number ?? 'RCP-2025-001' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Payment Date</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $receipt->payment_date ?? 'November 16, 2025' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Issue Date</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $receipt->issue_date ?? 'November 16, 2025' }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-sm font-semibold text-gray-500 uppercase mb-3">Payment Method</h2>
                    <div class="space-y-2">
                        <div>
                            <p class="text-xs text-gray-500">Method</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $receipt->payment_method ?? 'Bank Transfer' }}</p>
                        </div>
                        @if($receipt->reference ?? null)
                            <div>
                                <p class="text-xs text-gray-500">Reference/Transaction ID</p>
                                <p class="text-sm font-mono text-gray-900">{{ $receipt->reference }}</p>
                            </div>
                        @endif
                        <div>
                            <p class="text-xs text-gray-500">Status</p>
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-1">
                                <i class="fas fa-check-circle mr-1"></i> Confirmed
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client & Property Info -->
            <div class="grid grid-cols-2 gap-8 mb-8 pb-8 border-b-2 border-gray-200">
                <div>
                    <h2 class="text-sm font-semibold text-gray-500 uppercase mb-3">Received From</h2>
                    <div>
                        <p class="font-semibold text-gray-900 text-lg">{{ $client->name ?? 'John Doe' }}</p>
                        <p class="text-sm text-gray-600 mt-1">Client ID: {{ $client->reference ?? 'CLI-2025-001' }}</p>
                        <p class="text-sm text-gray-600">{{ $client->email ?? 'john@example.com' }}</p>
                        <p class="text-sm text-gray-600">{{ $client->phone ?? '+1 (555) 123-4567' }}</p>
                        @if($client->address ?? null)
                            <p class="text-sm text-gray-600 mt-2">{{ $client->address }}</p>
                        @endif
                    </div>
                </div>

                <div>
                    <h2 class="text-sm font-semibold text-gray-500 uppercase mb-3">Property Details</h2>
                    <div>
                        <p class="font-semibold text-gray-900 text-lg">{{ $property->title ?? '4 Bedroom Luxury Villa' }}</p>
                        <p class="text-sm text-gray-600 mt-1">Property ID: {{ $property->reference ?? 'PROP-2025-001' }}</p>
                        <p class="text-sm text-gray-600">{{ $property->address ?? '123 Beverly Hills Rd, Beverly Hills, CA 90210' }}</p>
                        <p class="text-sm text-gray-600 mt-2">Total Price: <span class="font-semibold">${{ number_format($property->price ?? 450000, 0) }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Payment Breakdown</h2>
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-300">
                            <th class="text-left py-3 text-sm font-semibold text-gray-700">Description</th>
                            <th class="text-right py-3 text-sm font-semibold text-gray-700">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-200">
                            <td class="py-4">
                                <p class="font-semibold text-gray-900">{{ $payment->milestone ?? 'Initial Deposit' }}</p>
                                <p class="text-sm text-gray-600">{{ $payment->description ?? '10% of purchase price' }}</p>
                            </td>
                            <td class="text-right py-4">
                                <p class="text-xl font-bold text-gray-900">${{ number_format($payment->amount ?? 45000, 2) }}</p>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="border-t-2 border-gray-300">
                            <td class="pt-4 pb-2">
                                <p class="text-lg font-bold text-gray-900">Total Amount Paid</p>
                            </td>
                            <td class="text-right pt-4 pb-2">
                                <p class="text-2xl font-bold text-green-600">${{ number_format($payment->amount ?? 45000, 2) }}</p>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Payment Summary -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-8">
                <h3 class="font-semibold text-gray-900 mb-4">Overall Payment Status</h3>
                <div class="grid grid-cols-3 gap-6">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Total Property Price</p>
                        <p class="text-lg font-bold text-gray-900">${{ number_format($property->price ?? 450000, 0) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Total Paid to Date</p>
                        <p class="text-lg font-bold text-green-600">${{ number_format($payment_summary->total_paid ?? 45000, 0) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Outstanding Balance</p>
                        <p class="text-lg font-bold text-orange-600">${{ number_format(($property->price ?? 450000) - ($payment_summary->total_paid ?? 45000), 0) }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between text-xs text-gray-600 mb-1">
                        <span>Payment Progress</span>
                        <span>{{ number_format((($payment_summary->total_paid ?? 45000) / ($property->price ?? 450000)) * 100, 1) }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ (($payment_summary->total_paid ?? 45000) / ($property->price ?? 450000)) * 100 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if($payment->notes ?? null)
                <div class="mb-8 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                    <p class="text-xs font-semibold text-blue-900 mb-1">Payment Notes:</p>
                    <p class="text-sm text-blue-800">{{ $payment->notes }}</p>
                </div>
            @endif

            <!-- Handled By -->
            <div class="mb-8">
                <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Handled By</h3>
                <div class="flex items-center space-x-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($realtor->name ?? 'Agent') }}" class="h-12 w-12 rounded-full" alt="">
                    <div>
                        <p class="font-semibold text-gray-900">{{ $realtor->name ?? 'Sarah Johnson' }}</p>
                        <p class="text-sm text-gray-600">{{ $realtor->role ?? 'Senior Real Estate Agent' }}</p>
                        <p class="text-sm text-gray-600">{{ $realtor->email ?? 'sarah@tenant.com' }} • {{ $realtor->phone ?? '+1 (555) 111-2222' }}</p>
                    </div>
                </div>
            </div>

            <!-- Footer Notes -->
            <div class="border-t-2 border-gray-200 pt-6">
                <div class="grid grid-cols-2 gap-8 text-xs text-gray-600">
                    <div>
                        <p class="font-semibold text-gray-900 mb-2">Agency Information</p>
                        <p>{{ $agency->name ?? 'Premier Realty' }}</p>
                        <p>{{ $agency->address ?? '456 Real Estate Ave, Los Angeles, CA' }}</p>
                        <p>{{ $agency->phone ?? '+1 (555) 000-0000' }}</p>
                        <p>{{ $agency->email ?? 'info@premierrealty.com' }}</p>
                        @if($agency->license ?? null)
                            <p class="mt-2">License: {{ $agency->license }}</p>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 mb-2">Important Notes</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>This is an official payment receipt</li>
                            <li>Please keep this receipt for your records</li>
                            <li>Payment is non-refundable except as per agreement</li>
                            <li>For queries, contact your assigned realtor</li>
                        </ul>
                    </div>
                </div>

                <!-- Digital Signature -->
                <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                    <p class="text-xs text-gray-500 mb-2">This receipt was auto-generated by the system</p>
                    <div class="flex items-center justify-center space-x-2 text-xs text-gray-600">
                        <i class="fas fa-shield-alt text-green-600"></i>
                        <span>Digitally verified and authenticated</span>
                        <span class="text-gray-400">•</span>
                        <span>Generated: {{ $receipt->generated_at ?? date('M d, Y h:i A') }}</span>
                    </div>
                    @if($receipt->blockchain_hash ?? null)
                        <p class="text-xs text-gray-500 mt-2 font-mono">Hash: {{ $receipt->blockchain_hash }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Receipt Footer -->
        <div class="bg-gray-100 px-8 py-6 text-center border-t border-gray-300">
            <p class="text-sm font-semibold text-gray-900">Thank you for your payment!</p>
            <p class="text-xs text-gray-600 mt-1">For questions about this receipt, please contact us at {{ $agency->phone ?? '+1 (555) 000-0000' }}</p>
            <div class="flex justify-center items-center space-x-4 mt-4 text-xs text-gray-500">
                <span><i class="fas fa-globe mr-1"></i> {{ $agency->website ?? 'www.premierrealty.com' }}</span>
                <span><i class="fas fa-envelope mr-1"></i> {{ $agency->email ?? 'info@premierrealty.com' }}</span>
            </div>
        </div>
    </div>

    <!-- QR Code Section (For digital verification) -->
    <div class="text-center py-8">
        <div class="inline-block bg-white p-6 rounded-lg shadow">
            <div class="bg-gray-200 h-32 w-32 mx-auto mb-2 flex items-center justify-center">
                <i class="fas fa-qrcode text-gray-400 text-5xl"></i>
            </div>
            <p class="text-xs text-gray-600">Scan to verify receipt authenticity</p>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #receipt-document, #receipt-document * {
        visibility: visible;
    }
    #receipt-document {
        position: absolute;
        left: 0;
        top: 0;
    }
}
</style>
@endsection
