@extends('layouts.app')

@section('title', 'Properties')
@section('page-title', 'Property Management')

@section('navigation')
    @include('agency.partials.navigation')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-secondary-900 dark:text-white">Property Listings</h1>
            <p class="mt-1 text-sm text-secondary-600 dark:text-secondary-400">Manage all your property listings in one place</p>
        </div>
        <button @click="$dispatch('open-slideout', { title: 'Add New Property', description: 'Create a new property listing' }); currentSlideout = 'add-property'"
                class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add Property
        </button>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Total Properties</p>
                    <p class="text-2xl font-bold text-secondary-900 dark:text-white mt-1">24</p>
                </div>
                <div class="bg-primary-100 dark:bg-primary-900 rounded-lg p-3">
                    <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Available</p>
                    <p class="text-2xl font-bold text-secondary-900 dark:text-white mt-1">18</p>
                </div>
                <div class="bg-success-100 dark:bg-success-900 rounded-lg p-3">
                    <svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Pending</p>
                    <p class="text-2xl font-bold text-secondary-900 dark:text-white mt-1">4</p>
                </div>
                <div class="bg-warning-100 dark:bg-warning-900 rounded-lg p-3">
                    <svg class="w-5 h-5 text-warning-600 dark:text-warning-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Sold</p>
                    <p class="text-2xl font-bold text-secondary-900 dark:text-white mt-1">2</p>
                </div>
                <div class="bg-secondary-100 dark:bg-secondary-700 rounded-lg p-3">
                    <svg class="w-5 h-5 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-4 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <input type="text" placeholder="Search properties..."
                           class="w-full pl-10 pr-4 py-2.5 bg-secondary-50 dark:bg-secondary-900 border border-secondary-200 dark:border-secondary-700 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors">
                    <svg class="absolute left-3 top-3 w-5 h-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <select class="px-4 py-2.5 bg-secondary-50 dark:bg-secondary-900 border border-secondary-200 dark:border-secondary-700 rounded-lg text-secondary-900 dark:text-white focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors">
                    <option value="">All Types</option>
                    <option value="sale">For Sale</option>
                    <option value="rent">For Rent</option>
                    <option value="lease">For Lease</option>
                </select>
                <select class="px-4 py-2.5 bg-secondary-50 dark:bg-secondary-900 border border-secondary-200 dark:border-secondary-700 rounded-lg text-secondary-900 dark:text-white focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors">
                    <option value="">All Status</option>
                    <option value="available">Available</option>
                    <option value="pending">Pending</option>
                    <option value="sold">Sold</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Properties Table -->
    <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-secondary-50 dark:bg-secondary-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Property</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Agent</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-secondary-200 dark:divide-secondary-700">
                    <!-- Sample Property Row 1 -->
                    <tr class="hover:bg-secondary-50 dark:hover:bg-secondary-700 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-12 w-12 rounded-lg bg-secondary-200 dark:bg-secondary-700 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-secondary-900 dark:text-white">Luxury Villa with Pool</div>
                                    <div class="text-sm text-secondary-500 dark:text-secondary-400">4 Beds • 3 Baths • 2,500 sqft</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-secondary-900 dark:text-white">For Sale</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-secondary-900 dark:text-white">Los Angeles, CA</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-secondary-900 dark:text-white">$450,000</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-success-100 dark:bg-success-900 text-success-800 dark:text-success-200">
                                Available
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-secondary-900 dark:text-white">John Smith</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-primary-600 hover:text-primary-700 mr-3">View</button>
                            <button class="text-secondary-600 hover:text-secondary-700 mr-3">Edit</button>
                            <button class="text-danger-600 hover:text-danger-700">Delete</button>
                        </td>
                    </tr>
                    <!-- Sample Property Row 2 -->
                    <tr class="hover:bg-secondary-50 dark:hover:bg-secondary-700 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-12 w-12 rounded-lg bg-secondary-200 dark:bg-secondary-700 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-secondary-900 dark:text-white">Modern Downtown Apartment</div>
                                    <div class="text-sm text-secondary-500 dark:text-secondary-400">2 Beds • 2 Baths • 1,200 sqft</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-secondary-900 dark:text-white">For Rent</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-secondary-900 dark:text-white">San Francisco, CA</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-secondary-900 dark:text-white">$3,200/mo</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-warning-100 dark:bg-warning-900 text-warning-800 dark:text-warning-200">
                                Pending
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-secondary-900 dark:text-white">Sarah Johnson</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-primary-600 hover:text-primary-700 mr-3">View</button>
                            <button class="text-secondary-600 hover:text-secondary-700 mr-3">Edit</button>
                            <button class="text-danger-600 hover:text-danger-700">Delete</button>
                        </td>
                    </tr>
                    <!-- Add more sample rows as needed -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-secondary-200 dark:border-secondary-700">
            <div class="flex items-center justify-between">
                <div class="text-sm text-secondary-600 dark:text-secondary-400">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">2</span> of <span class="font-medium">24</span> properties
                </div>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-2 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700 transition-colors">
                        Previous
                    </button>
                    <button class="px-3 py-2 bg-primary-600 text-white rounded-lg">1</button>
                    <button class="px-3 py-2 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700 transition-colors">2</button>
                    <button class="px-3 py-2 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700 transition-colors">3</button>
                    <button class="px-3 py-2 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700 transition-colors">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('slideouts')
    <!-- Add Property Form (same as in dashboard) -->
    <div x-show="currentSlideout === 'add-property'" x-cloak x-data="{ type: 'sale' }">
        <form action="{{ route('agency.properties.store') }}" method="POST" enctype="multipart/form-data" class="h-full flex flex-col">
            @csrf

            <!-- Form Content (Scrollable) -->
            <div class="flex-1 overflow-y-auto px-6 py-6 space-y-6">
                <!-- Basic Information -->
                <div>
                    <h3 class="text-sm font-semibold text-secondary-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Basic Information
                    </h3>
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Property Title <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" name="title" id="title" required
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="e.g., Luxury 4 Bedroom Villa with Pool">
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Price (USD) <span class="text-danger-600">*</span>
                            </label>
                            <input type="number" name="price" id="price" required
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="450000">
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Description <span class="text-danger-600">*</span>
                            </label>
                            <textarea name="description" id="description" rows="3" required
                                      class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                      placeholder="Describe the property..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions (Sticky Footer) -->
            <div class="flex-shrink-0 px-6 py-4 bg-secondary-50 dark:bg-secondary-900 border-t border-secondary-200 dark:border-secondary-700">
                <div class="flex justify-end space-x-3">
                    <button type="button" @click="slideoutOpen = false"
                            class="px-4 py-2.5 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-700 dark:text-secondary-200 bg-white dark:bg-secondary-800 hover:bg-secondary-50 dark:hover:bg-secondary-700 font-medium transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium flex items-center space-x-2 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Save Property</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
