<x-layouts.agency>
    <x-slot name="header">Dashboard</x-slot>
    <x-slot name="description">Welcome back! Here's what's happening with your real estate business today.</x-slot>

    <x-slot name="headerActions">
        <button
            @click="$dispatch('open-slide-panel', { component: 'create-property', title: 'Add New Property' })"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors"
        >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Property
        </button>
    </x-slot>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Properties -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Properties</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">248</p>
                    <p class="text-sm text-success-600 dark:text-success-400 mt-2">
                        <span class="font-medium">+12%</span> from last month
                    </p>
                </div>
                <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Leads -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Leads</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">156</p>
                    <p class="text-sm text-success-600 dark:text-success-400 mt-2">
                        <span class="font-medium">+8%</span> from last month
                    </p>
                </div>
                <div class="w-12 h-12 bg-success-100 dark:bg-success-900 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Monthly Sales -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Monthly Sales</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">₦45.2M</p>
                    <p class="text-sm text-success-600 dark:text-success-400 mt-2">
                        <span class="font-medium">+23%</span> from last month
                    </p>
                </div>
                <div class="w-12 h-12 bg-warning-100 dark:bg-warning-900 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-warning-600 dark:text-warning-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Team Members -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Team Members</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">32</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        <span class="font-medium">8</span> active today
                    </p>
                </div>
                <div class="w-12 h-12 bg-secondary-100 dark:bg-secondary-900 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Activity Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Sales Pipeline (2/3 width) -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Sales Pipeline</h3>
                <select class="text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                    <option>Last 7 days</option>
                    <option>Last 30 days</option>
                    <option>Last 90 days</option>
                </select>
            </div>

            <div class="space-y-4">
                <!-- Pipeline Stage -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">New Leads</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">45 deals</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-primary-600 h-2 rounded-full" style="width: 85%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Property Viewing</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">32 deals</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-success-600 h-2 rounded-full" style="width: 65%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Negotiation</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">18 deals</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-warning-600 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Closed Won</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">12 deals</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-success-500 h-2 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats (1/3 width) -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Quick Stats</h3>

            <div class="space-y-6">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Conversion Rate</span>
                        <span class="text-sm font-semibold text-success-600 dark:text-success-400">24.5%</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                        <div class="bg-success-600 h-1.5 rounded-full" style="width: 24.5%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Avg. Response Time</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">1.2 hrs</span>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">30 min faster than last week</p>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Avg. Deal Size</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">₦3.2M</span>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">+5% from last month</p>
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button
                        @click="$dispatch('show-toast', { message: 'Toast notification demo!', type: 'success' })"
                        class="w-full px-4 py-2 text-sm font-medium text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/30 hover:bg-primary-100 dark:hover:bg-primary-900/50 rounded-lg transition-colors"
                    >
                        View Detailed Analytics
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity and Top Performers -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activities -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Recent Activities</h3>

            <div class="space-y-4">
                <div class="flex items-start space-x-3 pb-4 border-b border-gray-200 dark:border-gray-700 last:border-0 last:pb-0">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-success-100 dark:bg-success-900 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Property Sold</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">3-bedroom apartment in Victoria Island</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">2 hours ago by John Adeleke</p>
                    </div>
                    <span class="text-sm font-semibold text-success-600 dark:text-success-400">₦45M</span>
                </div>

                <div class="flex items-start space-x-3 pb-4 border-b border-gray-200 dark:border-gray-700 last:border-0 last:pb-0">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">New Lead</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Sarah Johnson interested in Lekki plots</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">5 hours ago</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3 pb-4 border-b border-gray-200 dark:border-gray-700 last:border-0 last:pb-0">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-warning-100 dark:bg-warning-900 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-warning-600 dark:text-warning-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Appointment Scheduled</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Property viewing at Ikoyi Estate</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">1 day ago</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Performing Agents -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Top Performing Agents</h3>

            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                JD
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">John Adeleke</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">12 deals closed</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">₦156M</p>
                        <p class="text-xs text-success-600 dark:text-success-400">+15%</p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gradient-to-br from-success-500 to-success-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                AO
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Aisha Okonkwo</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">10 deals closed</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">₦124M</p>
                        <p class="text-xs text-success-600 dark:text-success-400">+22%</p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gradient-to-br from-warning-500 to-warning-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                TB
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Tunde Bello</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">8 deals closed</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">₦98M</p>
                        <p class="text-xs text-success-600 dark:text-success-400">+8%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.agency>
