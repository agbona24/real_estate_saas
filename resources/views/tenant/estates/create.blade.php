@extends('layouts.app')

@section('title', 'Register New Estate')

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
                    <i class="fas fa-map-marked-alt mr-2 text-purple-600"></i>
                    Register New Estate
                </h1>
                <p class="mt-1 text-sm text-gray-600">
                    Register estate and define total plot inventory
                </p>
            </div>
        </div>
    </div>

    <!-- Registration Form -->
    <form class="space-y-6">
        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-indigo-50">
                <h2 class="text-lg font-semibold text-gray-900">Basic Information</h2>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Estate Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" required placeholder="e.g., Sunset Gardens Estate" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Location/Address <span class="text-red-500">*</span>
                        </label>
                        <input type="text" required placeholder="e.g., Lekki Phase 2, Lagos" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Estate Type <span class="text-red-500">*</span>
                        </label>
                        <select required class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                            <option value="">Select Type</option>
                            <option value="residential">Residential</option>
                            <option value="commercial">Commercial</option>
                            <option value="mixed">Mixed Use</option>
                            <option value="industrial">Industrial</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Total Land Size
                        </label>
                        <div class="flex space-x-2">
                            <input type="number" step="0.01" placeholder="e.g., 50" class="flex-1 px-4 py-3 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                            <select class="px-4 py-3 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                                <option value="hectares">Hectares</option>
                                <option value="acres">Acres</option>
                                <option value="sqm">Sq Meters</option>
                            </select>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea rows="3" placeholder="Brief description of the estate..." class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Plot Inventory -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-50">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-th mr-2 text-green-600"></i>
                    Plot Inventory Setup
                </h2>
                <p class="text-sm text-gray-600 mt-1">Define total plots and pricing</p>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Total Number of Plots <span class="text-red-500">*</span>
                        </label>
                        <input type="number" min="1" required placeholder="e.g., 500"
                               id="total-plots"
                               class="w-full px-4 py-3 border-2 border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 text-lg font-bold">
                        <p class="text-xs text-gray-500 mt-1">This cannot be changed after registration</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Plot Size (Each)
                        </label>
                        <div class="flex space-x-2">
                            <input type="number" step="0.01" placeholder="600" class="flex-1 px-4 py-3 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                            <select class="px-4 py-3 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                                <option value="sqm">Sq M</option>
                                <option value="sqft">Sq Ft</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Price Per Plot <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-3.5 text-gray-500 text-lg">$</span>
                            <input type="number" min="0" step="0.01" required placeholder="25,000"
                                   id="price-per-plot"
                                   class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                        </div>
                    </div>
                </div>

                <!-- Total Value Preview -->
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border-2 border-purple-200 rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Estimated Total Estate Value</p>
                            <p class="text-4xl font-bold text-purple-600" id="total-value">$0</p>
                        </div>
                        <i class="fas fa-calculator text-purple-300 text-5xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phases (Optional) -->
        <div class="bg-white rounded-lg shadow-lg" x-data="{ hasPhases: false, phases: [{ name: '', plots: '', price: '' }] }">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-layer-group mr-2 text-blue-600"></i>
                        Phases (Optional)
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Divide estate into development phases</p>
                </div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" x-model="hasPhases" class="h-4 w-4 text-purple-600 rounded">
                    <span class="ml-2 text-sm text-gray-700">Enable Phases</span>
                </label>
            </div>
            <div x-show="hasPhases" class="p-6 space-y-4">
                <template x-for="(phase, index) in phases" :key="index">
                    <div class="border border-gray-300 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-medium text-gray-900">Phase <span x-text="index + 1"></span></h3>
                            <button type="button" x-show="phases.length > 1" @click="phases.splice(index, 1)" class="text-red-600 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phase Name</label>
                                <input type="text" x-model="phase.name" placeholder="e.g., Phase 1" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Plots in Phase</label>
                                <input type="number" x-model="phase.plots" placeholder="e.g., 150" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Price Per Plot</label>
                                <input type="number" x-model="phase.price" placeholder="$25,000" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>
                </template>
                <button type="button" @click="phases.push({ name: '', plots: '', price: '' })" class="w-full bg-white border-2 border-dashed border-gray-300 hover:border-purple-500 text-gray-600 hover:text-purple-600 px-4 py-3 rounded-md">
                    <i class="fas fa-plus mr-2"></i> Add Another Phase
                </button>
            </div>
        </div>

        <!-- Site Map Upload -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-image mr-2 text-orange-600"></i>
                    Estate Layout / Site Map
                </h2>
                <p class="text-sm text-gray-600 mt-1">Upload estate site plan for visual plot selection</p>
            </div>
            <div class="p-6">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-purple-500 cursor-pointer transition">
                    <i class="fas fa-cloud-upload-alt text-gray-400 text-5xl mb-4"></i>
                    <p class="text-gray-700 font-medium mb-1">Click to upload estate layout</p>
                    <p class="text-sm text-gray-500">PNG, JPG, PDF up to 10MB</p>
                    <input type="file" accept="image/*,.pdf" class="hidden">
                </div>
                <p class="text-xs text-gray-500 mt-3">
                    <i class="fas fa-info-circle mr-1"></i>
                    You can map individual plots to the layout after registration
                </p>
            </div>
        </div>

        <!-- Low Stock Alert Settings -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-yellow-50 to-orange-50">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-bell mr-2 text-yellow-600"></i>
                    Automatic Alerts
                </h2>
                <p class="text-sm text-gray-600 mt-1">Configure low stock notifications</p>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="flex items-center p-4 border-2 border-yellow-200 bg-yellow-50 rounded-lg cursor-pointer">
                        <input type="checkbox" checked class="h-4 w-4 text-yellow-600 rounded">
                        <span class="ml-3 text-sm font-medium text-gray-900">Alert at 50% remaining</span>
                    </label>
                    <label class="flex items-center p-4 border-2 border-orange-200 bg-orange-50 rounded-lg cursor-pointer">
                        <input type="checkbox" checked class="h-4 w-4 text-orange-600 rounded">
                        <span class="ml-3 text-sm font-medium text-gray-900">Alert at 20% remaining</span>
                    </label>
                    <label class="flex items-center p-4 border-2 border-red-200 bg-red-50 rounded-lg cursor-pointer">
                        <input type="checkbox" checked class="h-4 w-4 text-red-600 rounded">
                        <span class="ml-3 text-sm font-medium text-gray-900">Alert at 5% remaining</span>
                    </label>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-sm text-blue-800">
                        <i class="fas fa-info-circle mr-2"></i>
                        The system will automatically prevent over-allocation beyond available plots and send notifications when thresholds are reached.
                    </p>
                </div>
            </div>
        </div>

        <!-- Reservation Settings -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-clock mr-2 text-indigo-600"></i>
                    Reservation & Allocation Rules
                </h2>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Reservation Expiry Period
                        </label>
                        <div class="flex space-x-2">
                            <input type="number" value="7" min="1" class="flex-1 px-4 py-2 border border-gray-300 rounded-md">
                            <select class="px-4 py-2 border border-gray-300 rounded-md">
                                <option value="days">Days</option>
                                <option value="hours">Hours</option>
                            </select>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Plots auto-release if payment not completed</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Minimum Deposit Required
                        </label>
                        <div class="flex space-x-2">
                            <input type="number" value="10" min="0" max="100" class="flex-1 px-4 py-2 border border-gray-300 rounded-md">
                            <select class="px-4 py-2 border border-gray-300 rounded-md">
                                <option value="percentage">% of plot price</option>
                                <option value="fixed">Fixed amount</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-purple-600 rounded">
                        <span class="ml-2 text-sm text-gray-700">Auto-reserve plot on initial deposit</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-purple-600 rounded">
                        <span class="ml-2 text-sm text-gray-700">Auto-allocate plot on full payment completion</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-purple-600 rounded">
                        <span class="ml-2 text-sm text-gray-700">Send notifications to realtors on allocation</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="h-4 w-4 text-purple-600 rounded">
                        <span class="ml-2 text-sm text-gray-700">Prevent over-allocation (strict inventory control)</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-between items-center">
            <button type="button" onclick="window.history.back()" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-md font-semibold">
                Cancel
            </button>
            <div class="flex space-x-3">
                <button type="button" class="bg-white border border-purple-600 text-purple-600 hover:bg-purple-50 px-6 py-3 rounded-md font-semibold">
                    <i class="fas fa-save mr-2"></i> Save as Draft
                </button>
                <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-8 py-3 rounded-md font-semibold shadow-lg">
                    <i class="fas fa-check-circle mr-2"></i> Register Estate
                </button>
            </div>
        </div>
    </form>
</div>

<script>
// Calculate total estate value
function calculateTotal() {
    const plots = parseInt(document.getElementById('total-plots')?.value || 0);
    const price = parseFloat(document.getElementById('price-per-plot')?.value || 0);
    const total = plots * price;

    const totalElement = document.getElementById('total-value');
    if (totalElement) {
        if (total >= 1000000) {
            totalElement.textContent = '$' + (total / 1000000).toFixed(2) + 'M';
        } else if (total >= 1000) {
            totalElement.textContent = '$' + (total / 1000).toFixed(1) + 'K';
        } else {
            totalElement.textContent = '$' + total.toLocaleString();
        }
    }
}

document.getElementById('total-plots')?.addEventListener('input', calculateTotal);
document.getElementById('price-per-plot')?.addEventListener('input', calculateTotal);
</script>
@endsection
