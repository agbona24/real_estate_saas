<x-layouts.agency>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Sales & Transactions</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Track all property sales, deals, and transactions</p>
            </div>
            <button
                @click="$dispatch('open-slide-panel', {
                    title: 'Record New Transaction',
                    component: 'agency.forms.create-transaction'
                })"
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Transaction
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Revenue -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">₦4.2B</p>
                        <p class="mt-1 text-sm text-green-600 dark:text-green-400">+18% from last month</p>
                    </div>
                </div>
            </div>

            <!-- Completed Deals -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Completed Deals</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">127</p>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">This month: 24</p>
                    </div>
                </div>
            </div>

            <!-- Pending Transactions -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-warning-100 dark:bg-warning-900 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-warning-600 dark:text-warning-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">38</p>
                        <p class="mt-1 text-sm text-warning-600 dark:text-warning-400">₦892M in progress</p>
                    </div>
                </div>
            </div>

            <!-- Avg Deal Value -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Avg Deal Value</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">₦33M</p>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Median: ₦28M</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Search -->
                <div class="lg:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Search Transactions
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
                            placeholder="Search by property, client, or transaction ID..."
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
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <!-- Payment Type Filter -->
                <div>
                    <label for="payment-type-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Payment Type
                    </label>
                    <select
                        id="payment-type-filter"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    >
                        <option value="">All Types</option>
                        <option value="outright">Outright</option>
                        <option value="installment">Installment</option>
                        <option value="mortgage">Mortgage</option>
                    </select>
                </div>

                <!-- Date Range -->
                <div>
                    <label for="date-range" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Date Range
                    </label>
                    <select
                        id="date-range"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    >
                        <option value="all">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month" selected>This Month</option>
                        <option value="quarter">This Quarter</option>
                        <option value="year">This Year</option>
                        <option value="custom">Custom Range</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Transactions</h3>
            </div>

            <x-agency.data-table :headers="['Transaction ID', 'Property', 'Client', 'Amount', 'Payment Type', 'Status', 'Date', 'Agent', 'Actions']">
                <!-- Transaction 1 -->
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">TXN-2024-0847</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=100&h=100&fit=crop" alt="Property" class="w-10 h-10 rounded object-cover mr-3">
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">5BR Detached Duplex</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Banana Island, Ikoyi</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-white">Chief Adekunle Obi</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">+234 803 456 7890</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">₦450,000,000</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full">
                            Outright
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full">
                            Completed
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        Nov 15, 2024
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="https://ui-avatars.com/api/?name=John+Adeleke&background=FF2D20&color=fff" alt="Agent" class="w-8 h-8 rounded-full mr-2">
                            <div class="text-sm text-gray-900 dark:text-white">John Adeleke</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-3">
                            <button class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
                                View
                            </button>
                            <button class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                Invoice
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Transaction 2 -->
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">TXN-2024-0846</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=100&h=100&fit=crop" alt="Property" class="w-10 h-10 rounded object-cover mr-3">
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">3BR Apartment</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Victoria Island</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-white">Mrs. Fatima Hassan</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">+234 809 234 5678</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">₦85,000,000</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 rounded-full">
                            Installment
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full">
                            Processing
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        Nov 14, 2024
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="https://ui-avatars.com/api/?name=Aisha+Okonkwo&background=FF2D20&color=fff" alt="Agent" class="w-8 h-8 rounded-full mr-2">
                            <div class="text-sm text-gray-900 dark:text-white">Aisha Okonkwo</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-3">
                            <button class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
                                View
                            </button>
                            <button class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                Invoice
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Transaction 3 -->
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">TXN-2024-0845</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=100&h=100&fit=crop" alt="Property" class="w-10 h-10 rounded object-cover mr-3">
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">2BR Flat</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Lekki Phase 1</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-white">Mr. Chinedu Okafor</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">+234 701 123 4567</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">₦42,000,000</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full">
                            Mortgage
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full">
                            Pending
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        Nov 13, 2024
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="https://ui-avatars.com/api/?name=Tunde+Bello&background=FF2D20&color=fff" alt="Agent" class="w-8 h-8 rounded-full mr-2">
                            <div class="text-sm text-gray-900 dark:text-white">Tunde Bello</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-3">
                            <button class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
                                View
                            </button>
                            <button class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                Invoice
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Transaction 4 -->
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">TXN-2024-0844</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=100&h=100&fit=crop" alt="Property" class="w-10 h-10 rounded object-cover mr-3">
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">4BR Terrace</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Ajah</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-white">Dr. Oluwaseun Balogun</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">+234 806 987 6543</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">₦68,500,000</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full">
                            Outright
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full">
                            Completed
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        Nov 12, 2024
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="https://ui-avatars.com/api/?name=Chioma+Nwankwo&background=FF2D20&color=fff" alt="Agent" class="w-8 h-8 rounded-full mr-2">
                            <div class="text-sm text-gray-900 dark:text-white">Chioma Nwankwo</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-3">
                            <button class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
                                View
                            </button>
                            <button class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                Invoice
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Transaction 5 -->
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">TXN-2024-0843</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=100&h=100&fit=crop" alt="Property" class="w-10 h-10 rounded object-cover mr-3">
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Commercial Space</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Ikeja GRA</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-white">Zenith Holdings Ltd</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">+234 802 345 6789</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">₦225,000,000</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 rounded-full">
                            Installment
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full">
                            Processing
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        Nov 11, 2024
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="https://ui-avatars.com/api/?name=John+Adeleke&background=FF2D20&color=fff" alt="Agent" class="w-8 h-8 rounded-full mr-2">
                            <div class="text-sm text-gray-900 dark:text-white">John Adeleke</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-3">
                            <button class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
                                View
                            </button>
                            <button class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                Invoice
                            </button>
                        </div>
                    </td>
                </tr>
            </x-agency.data-table>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Showing <span class="font-medium text-gray-900 dark:text-white">1</span> to <span class="font-medium text-gray-900 dark:text-white">5</span> of <span class="font-medium text-gray-900 dark:text-white">127</span> results
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
    </div>
</x-layouts.agency>
