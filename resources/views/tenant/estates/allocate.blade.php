@extends('layouts.app')

@section('title', 'Allocate Plot')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <button onclick="window.history.back()" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left text-xl"></i>
            </button>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    <i class="fas fa-user-plus mr-2 text-green-600"></i>
                    Allocate Plot to Client
                </h1>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $estate->name ?? 'Sunset Gardens Estate' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Auto-Inventory Warning -->
    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-lg">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-600 text-xl mt-0.5 mr-3"></i>
            <div>
                <p class="text-sm font-medium text-blue-900">Automatic Inventory Management</p>
                <p class="text-sm text-blue-700 mt-1">
                    The system will automatically subtract allocated plots from available inventory and prevent over-allocation.
                    Reservations expire in {{ $estate->reservation_expiry ?? 7 }} days if payment is not completed.
                </p>
            </div>
        </div>
    </div>

    <form class="space-y-6">
        <!-- Plot Selection -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-indigo-50">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-map-pin mr-2 text-purple-600"></i>
                    Select Plot
                </h2>
            </div>
            <div class="p-6 space-y-6">
                <!-- Available Plots Count -->
                <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div>
                        <p class="text-sm text-green-700">Available Plots</p>
                        <p class="text-3xl font-bold text-green-900">{{ number_format($inventory->available ?? 342) }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Out of {{ number_format($estate->total_plots ?? 500) }} total</p>
                        <p class="text-xs text-gray-500 mt-1">{{ number_format($inventory->available_percentage ?? 68.4, 1) }}% remaining</p>
                    </div>
                </div>

                <!-- Plot Selection Method -->
                <div x-data="{ method: 'auto' }">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Selection Method</label>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <button type="button" @click="method = 'auto'" :class="method === 'auto' ? 'bg-purple-600 text-white' : 'bg-white text-gray-700 border border-gray-300'" class="px-4 py-3 rounded-lg font-medium hover:shadow-md transition">
                            <i class="fas fa-magic mr-2"></i> Auto-Select Next Available
                        </button>
                        <button type="button" @click="method = 'manual'" :class="method === 'manual' ? 'bg-purple-600 text-white' : 'bg-white text-gray-700 border border-gray-300'" class="px-4 py-3 rounded-lg font-medium hover:shadow-md transition">
                            <i class="fas fa-hand-pointer mr-2"></i> Manually Choose Plot
                        </button>
                    </div>

                    <!-- Auto-Select (Default) -->
                    <div x-show="method === 'auto'" class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <p class="text-sm text-gray-700">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            System will automatically assign the next available plot number
                        </p>
                        <p class="text-lg font-bold text-purple-600 mt-2">Next Available: Plot #342</p>
                    </div>

                    <!-- Manual Selection -->
                    <div x-show="method === 'manual'">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Choose Plot Number</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                            <option value="">Select from available plots...</option>
                            @for($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}">Plot #{{ str_pad($i, 3, '0', STR_PAD_LEFT) }} - Available</option>
                            @endfor
                        </select>
                        <button type="button" class="mt-2 text-sm text-purple-600 hover:text-purple-700 font-medium">
                            <i class="fas fa-th mr-1"></i> View All Plots on Map
                        </button>
                    </div>
                </div>

                <!-- Phase Selection (if applicable) -->
                @if($estate->phases_count ?? 0)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phase</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-md">
                            @foreach($phases ?? [] as $phase)
                                <option value="{{ $phase->id }}">
                                    {{ $phase->name }} - {{ $phase->available_plots }} available
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        </div>

        <!-- Client Selection -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-50">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-user mr-2 text-green-600"></i>
                    Client Information
                </h2>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Select Client <span class="text-red-500">*</span>
                        </label>
                        <select required class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                            <option value="">Choose existing client...</option>
                            @foreach($clients ?? [] as $client)
                                <option value="{{ $client->id }}">{{ $client->name }} - {{ $client->reference }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="mt-2 text-sm text-green-600 hover:text-green-700 font-medium">
                            <i class="fas fa-plus mr-1"></i> Add New Client
                        </button>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Assigned Realtor
                        </label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-md">
                            @foreach($realtors ?? [] as $realtor)
                                <option value="{{ $realtor->id }}">{{ $realtor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Allocation Date
                        </label>
                        <input type="date" value="{{ date('Y-m-d') }}" class="w-full px-4 py-3 border border-gray-300 rounded-md">
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-yellow-50 to-orange-50">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-dollar-sign mr-2 text-yellow-600"></i>
                    Payment & Status
                </h2>
            </div>
            <div class="p-6 space-y-6">
                <!-- Plot Price -->
                <div class="p-4 bg-purple-50 border border-purple-200 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Plot Price</p>
                            <p class="text-3xl font-bold text-purple-600">${{ number_format($estate->price_per_plot ?? 25000, 0) }}</p>
                        </div>
                        <i class="fas fa-tag text-purple-300 text-5xl"></i>
                    </div>
                </div>

                <!-- Allocation Type -->
                <div x-data="{ allocationType: 'full' }">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Allocation Type</label>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <button type="button" @click="allocationType = 'full'" :class="allocationType === 'full' ? 'bg-green-600 text-white' : 'bg-white text-gray-700 border border-gray-300'" class="px-4 py-3 rounded-lg font-medium">
                            <i class="fas fa-check-double mr-2"></i> Full Payment
                        </button>
                        <button type="button" @click="allocationType = 'partial'" :class="allocationType === 'partial' ? 'bg-yellow-600 text-white' : 'bg-white text-gray-700 border border-gray-300'" class="px-4 py-3 rounded-lg font-medium">
                            <i class="fas fa-clock mr-2"></i> Partial Payment (Reserve)
                        </button>
                    </div>

                    <!-- Full Payment -->
                    <div x-show="allocationType === 'full'" class="space-y-4">
                        <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                            <p class="text-sm text-green-800">
                                <i class="fas fa-info-circle mr-2"></i>
                                Plot will be immediately <strong>allocated</strong> and marked as sold
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Amount Paid</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3.5 text-gray-500">$</span>
                                    <input type="number" value="{{ $estate->price_per_plot ?? 25000 }}" readonly class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-md bg-gray-50 font-bold">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                                <select class="w-full px-4 py-3 border border-gray-300 rounded-md">
                                    <option>Bank Transfer</option>
                                    <option>Cash</option>
                                    <option>Check</option>
                                    <option>Card</option>
                                    <option>Online Payment</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Partial Payment (Reservation) -->
                    <div x-show="allocationType === 'partial'" class="space-y-4">
                        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-sm text-yellow-800">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Plot will be <strong>reserved</strong> for {{ $estate->reservation_expiry ?? 7 }} days. Auto-released if balance not paid.
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Initial Deposit</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3.5 text-gray-500">$</span>
                                    <input type="number" placeholder="{{ ($estate->price_per_plot ?? 25000) * 0.1 }}" class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-md">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Minimum: ${{ number_format(($estate->price_per_plot ?? 25000) * 0.1, 0) }} (10%)</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Balance Due</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3.5 text-gray-500">$</span>
                                    <input type="number" readonly value="{{ ($estate->price_per_plot ?? 25000) * 0.9 }}" class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-md bg-gray-50">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Reservation Expires</label>
                            <input type="date" value="{{ date('Y-m-d', strtotime('+7 days')) }}" class="w-full px-4 py-3 border border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Transaction Reference</label>
                    <input type="text" placeholder="e.g., TRF123456789" class="w-full px-4 py-3 border border-gray-300 rounded-md">
                </div>
            </div>
        </div>

        <!-- Auto-Actions Preview -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-cyan-50">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-cogs mr-2 text-blue-600"></i>
                    Automated Actions
                </h2>
                <p class="text-sm text-gray-600 mt-1">What happens when you submit this allocation</p>
            </div>
            <div class="p-6 space-y-3">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-check-circle text-green-600 mt-1"></i>
                    <div>
                        <p class="font-medium text-gray-900">Subtract from Available Inventory</p>
                        <p class="text-sm text-gray-600">{{ number_format($inventory->available ?? 342) }} → {{ number_format(($inventory->available ?? 342) - 1) }} plots</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-check-circle text-green-600 mt-1"></i>
                    <div>
                        <p class="font-medium text-gray-900">Link Plot to Client Transaction</p>
                        <p class="text-sm text-gray-600">Create transaction record with payment schedule</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-check-circle text-green-600 mt-1"></i>
                    <div>
                        <p class="font-medium text-gray-900">Generate Documentation</p>
                        <p class="text-sm text-gray-600">Auto-create allocation letter and receipt</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-check-circle text-green-600 mt-1"></i>
                    <div>
                        <p class="font-medium text-gray-900">Send Notifications</p>
                        <p class="text-sm text-gray-600">Email/SMS to client and assigned realtor</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-check-circle text-green-600 mt-1"></i>
                    <div>
                        <p class="font-medium text-gray-900">Update Analytics Dashboard</p>
                        <p class="text-sm text-gray-600">Real-time sales progress and inventory tracking</p>
                    </div>
                </div>

                @if(($inventory->available_percentage ?? 68.4) - (100 / ($estate->total_plots ?? 500)) <= 20)
                    <div class="flex items-start space-x-3 mt-4 p-3 bg-red-50 border border-red-200 rounded">
                        <i class="fas fa-exclamation-triangle text-red-600 mt-1"></i>
                        <div>
                            <p class="font-medium text-red-900">Low Stock Alert</p>
                            <p class="text-sm text-red-700">This allocation will trigger low stock notification (below 20% remaining)</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-between items-center">
            <button type="button" onclick="window.history.back()" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-md font-semibold">
                Cancel
            </button>
            <div class="flex space-x-3">
                <button type="button" class="bg-white border border-green-600 text-green-600 hover:bg-green-50 px-6 py-3 rounded-md font-semibold">
                    <i class="fas fa-eye mr-2"></i> Preview Documents
                </button>
                <button type="submit" class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-8 py-3 rounded-md font-semibold shadow-lg">
                    <i class="fas fa-check-circle mr-2"></i> Confirm Allocation
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
