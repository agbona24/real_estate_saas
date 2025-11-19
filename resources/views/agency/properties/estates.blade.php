<x-layouts.agency>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Estates & Projects</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage property developments, estates, and large-scale projects</p>
            </div>
            <button
                @click="$dispatch('open-slide-panel', {
                    title: 'Add New Estate/Project',
                    component: 'agency.forms.create-estate'
                })"
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Estate
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Projects -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Projects</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">24</p>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">3 new this month</p>
                    </div>
                </div>
            </div>

            <!-- Active Estates -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Estates</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">18</p>
                        <p class="mt-1 text-sm text-green-600 dark:text-green-400">75% occupancy rate</p>
                    </div>
                </div>
            </div>

            <!-- Total Units/Plots -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1v-5zM14 15a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1h-4a1 1 0 01-1-1v-5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Units/Plots</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">586</p>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">412 sold, 174 available</p>
                    </div>
                </div>
            </div>

            <!-- Estimated Value -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Portfolio Value</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">₦18.4B</p>
                        <p class="mt-1 text-sm text-purple-600 dark:text-purple-400">All estates combined</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="lg:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Search Estates
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            type="search"
                            id="search"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            placeholder="Search by name, location, or developer..."
                        />
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label for="status-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Status
                    </label>
                    <select
                        id="status-filter"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    >
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="under_construction">Under Construction</option>
                        <option value="completed">Completed</option>
                        <option value="planning">Planning</option>
                    </select>
                </div>

                <!-- Location Filter -->
                <div>
                    <label for="location-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Location
                    </label>
                    <select
                        id="location-filter"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    >
                        <option value="">All Locations</option>
                        <option value="lekki">Lekki</option>
                        <option value="ikoyi">Ikoyi</option>
                        <option value="vi">Victoria Island</option>
                        <option value="ajah">Ajah</option>
                        <option value="ibeju_lekki">Ibeju-Lekki</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Estates Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Estate 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
                <div class="relative h-48">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&h=400&fit=crop" alt="Estate" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded-full">Active</span>
                    </div>
                    <div class="absolute bottom-4 left-4">
                        <span class="px-3 py-1 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-xs font-semibold rounded-full">
                            42 Units Available
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Lekki Gardens Estate</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Lekki Phase 1, Lagos</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total Units</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">120</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Sold</p>
                            <p class="text-sm font-semibold text-green-600 dark:text-green-400">78</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Available</p>
                            <p class="text-sm font-semibold text-primary-600 dark:text-primary-400">42</p>
                        </div>
                    </div>

                    <div class="space-y-2 mb-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Price Range:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₦35M - ₦85M</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Estate Value:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₦6.2B</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Completion:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">85%</span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-1">
                            <span>Sales Progress</span>
                            <span>65%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-primary-600 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button class="flex-1 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
                            View Units
                        </button>
                        <button class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            <!-- Estate 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
                <div class="relative h-48">
                    <img src="https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=800&h=400&fit=crop" alt="Estate" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-yellow-500 text-white text-xs font-semibold rounded-full">Under Construction</span>
                    </div>
                    <div class="absolute bottom-4 left-4">
                        <span class="px-3 py-1 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-xs font-semibold rounded-full">
                            58 Plots Available
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Pearl Gardens</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Ibeju-Lekki, Lagos</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total Plots</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">150</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Reserved</p>
                            <p class="text-sm font-semibold text-orange-600 dark:text-orange-400">92</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Available</p>
                            <p class="text-sm font-semibold text-primary-600 dark:text-primary-400">58</p>
                        </div>
                    </div>

                    <div class="space-y-2 mb-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Price Range:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₦12M - ₦25M</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Estate Value:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₦2.8B</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Completion:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">45%</span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-1">
                            <span>Sales Progress</span>
                            <span>61%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-orange-500 h-2 rounded-full" style="width: 61%"></div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button class="flex-1 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
                            View Plots
                        </button>
                        <button class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            <!-- Estate 3 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
                <div class="relative h-48">
                    <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800&h=400&fit=crop" alt="Estate" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded-full">Active</span>
                    </div>
                    <div class="absolute bottom-4 left-4">
                        <span class="px-3 py-1 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-xs font-semibold rounded-full">
                            12 Villas Available
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Banana Island Residences</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Banana Island, Ikoyi</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total Villas</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">45</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Sold</p>
                            <p class="text-sm font-semibold text-green-600 dark:text-green-400">33</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Available</p>
                            <p class="text-sm font-semibold text-primary-600 dark:text-primary-400">12</p>
                        </div>
                    </div>

                    <div class="space-y-2 mb-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Price Range:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₦280M - ₦650M</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Estate Value:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₦18.5B</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Completion:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">100%</span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-1">
                            <span>Sales Progress</span>
                            <span>73%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-primary-600 h-2 rounded-full" style="width: 73%"></div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button class="flex-1 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
                            View Villas
                        </button>
                        <button class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            <!-- Estate 4 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
                <div class="relative h-48">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&h=400&fit=crop" alt="Estate" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-blue-500 text-white text-xs font-semibold rounded-full">Planning</span>
                    </div>
                    <div class="absolute bottom-4 left-4">
                        <span class="px-3 py-1 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-xs font-semibold rounded-full">
                            200 Units Planned
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Victoria Heights</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Victoria Island, Lagos</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total Units</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">200</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Pre-sold</p>
                            <p class="text-sm font-semibold text-blue-600 dark:text-blue-400">45</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Available</p>
                            <p class="text-sm font-semibold text-primary-600 dark:text-primary-400">155</p>
                        </div>
                    </div>

                    <div class="space-y-2 mb-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Price Range:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₦55M - ₦125M</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Estimated Value:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₦14.2B</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Launch Date:</span>
                            <span class="font-semibold text-gray-900 dark:text-white">Q2 2025</span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-1">
                            <span>Pre-sales Progress</span>
                            <span>23%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 23%"></div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button class="flex-1 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
                            View Plans
                        </button>
                        <button class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Showing <span class="font-medium text-gray-900 dark:text-white">1</span> to <span class="font-medium text-gray-900 dark:text-white">4</span> of <span class="font-medium text-gray-900 dark:text-white">24</span> estates
                </div>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        Previous
                    </button>
                    <button class="px-3 py-1 bg-primary-600 text-white rounded-lg text-sm">1</button>
                    <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">2</button>
                    <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">3</button>
                    <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layouts.agency>
