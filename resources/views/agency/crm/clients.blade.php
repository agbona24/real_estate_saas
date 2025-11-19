<x-layouts.agency>
    <x-slot name="header">Clients</x-slot>
    <x-slot name="description">Manage your client relationships and interactions</x-slot>

    <x-slot name="headerActions">
        <div class="flex items-center space-x-3">
            <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export
            </button>
            <button
                @click="$dispatch('open-slide-panel', { component: 'create-client', title: 'Add New Client' })"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Client
            </button>
        </div>
    </x-slot>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Clients</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">342</p>
                    <p class="text-sm text-success-600 dark:text-success-400 mt-1">+18 this month</p>
                </div>
                <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Clients</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">298</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">87% of total</p>
                </div>
                <div class="w-10 h-10 bg-success-100 dark:bg-success-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Properties Purchased</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">156</p>
                    <p class="text-sm text-success-600 dark:text-success-400 mt-1">+12 this quarter</p>
                </div>
                <div class="w-10 h-10 bg-warning-100 dark:bg-warning-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-warning-600 dark:text-warning-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Avg. Client Value</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">₦32M</p>
                    <p class="text-sm text-success-600 dark:text-success-400 mt-1">+8% from last year</p>
                </div>
                <div class="w-10 h-10 bg-secondary-100 dark:bg-secondary-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="md:col-span-2">
                <input
                    type="text"
                    placeholder="Search by name, email, phone..."
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 text-sm"
                />
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                    <option value="">All Types</option>
                    <option>Individual</option>
                    <option>Corporate</option>
                    <option>Government</option>
                </select>
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                    <option value="">All Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                    <option>VIP</option>
                </select>
            </div>
            <div>
                <button class="w-full px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                    Reset Filters
                </button>
            </div>
        </div>
    </div>

    <!-- Clients Table -->
    <x-agency.data-table :headers="['Client', 'Contact', 'Type', 'Properties Owned', 'Total Value', 'Last Purchase', 'Status']">
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                            OA
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">Oluwaseun Adeyemi</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Client #CL-2024-001</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-900 dark:text-white">oluwaseun.a@email.com</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">+234 901 234 5678</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-primary-100 dark:bg-primary-900 text-primary-800 dark:text-primary-200 rounded-full">
                    Individual
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">3</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-primary-600 dark:text-primary-400">₦125M</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">2 weeks ago</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-warning-100 dark:bg-warning-900 text-warning-800 dark:text-warning-200">
                    <span class="w-2 h-2 mr-1 bg-warning-500 rounded-full"></span>
                    VIP
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex items-center justify-end space-x-2">
                    <button
                        @click="$dispatch('show-toast', { message: 'Email sent to client!', type: 'success' })"
                        class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300"
                        title="Send Email"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </button>
                    <button class="text-primary-600 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300" title="View Details">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    <button class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>

        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-gradient-to-br from-success-500 to-success-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                            TL
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">TechCorp Limited</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Client #CL-2024-002</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-900 dark:text-white">info@techcorp.com</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">+234 802 345 6789</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-success-100 dark:bg-success-900 text-success-800 dark:text-success-200 rounded-full">
                    Corporate
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">5</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-primary-600 dark:text-primary-400">₦250M</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">1 month ago</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-warning-100 dark:bg-warning-900 text-warning-800 dark:text-warning-200">
                    <span class="w-2 h-2 mr-1 bg-warning-500 rounded-full"></span>
                    VIP
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex items-center justify-end space-x-2">
                    <button
                        @click="$dispatch('show-toast', { message: 'Email sent to client!', type: 'success' })"
                        class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300"
                        title="Send Email"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </button>
                    <button class="text-primary-600 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300" title="View Details">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    <button class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>

        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-gradient-to-br from-warning-500 to-warning-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                            CN
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">Chidinma Nwosu</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Client #CL-2024-003</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-900 dark:text-white">chidinma.n@email.com</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">+234 703 456 7890</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-primary-100 dark:bg-primary-900 text-primary-800 dark:text-primary-200 rounded-full">
                    Individual
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">2</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-primary-600 dark:text-primary-400">₦78M</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">3 months ago</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success-100 dark:bg-success-900 text-success-800 dark:text-success-200">
                    <span class="w-2 h-2 mr-1 bg-success-500 rounded-full"></span>
                    Active
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex items-center justify-end space-x-2">
                    <button
                        @click="$dispatch('show-toast', { message: 'Email sent to client!', type: 'success' })"
                        class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300"
                        title="Send Email"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </button>
                    <button class="text-primary-600 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300" title="View Details">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    <button class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
    </x-agency.data-table>
</x-layouts.agency>
