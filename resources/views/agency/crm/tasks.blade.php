<x-layouts.agency>
    <x-slot name="header">Tasks</x-slot>
    <x-slot name="description">Manage and track your team's tasks and activities</x-slot>

    <x-slot name="headerActions">
        <div class="flex items-center space-x-3">
            <div class="flex items-center bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
                <button
                    @click="view = 'board'"
                    :class="view === 'board' ? 'bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm' : 'text-gray-600 dark:text-gray-400'"
                    class="px-3 py-1.5 text-sm font-medium rounded-md transition-colors"
                    x-data="{ view: 'board' }"
                >
                    Board
                </button>
                <button
                    @click="view = 'list'"
                    :class="view === 'list' ? 'bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm' : 'text-gray-600 dark:text-gray-400'"
                    class="px-3 py-1.5 text-sm font-medium rounded-md transition-colors"
                >
                    List
                </button>
            </div>
            <button
                @click="$dispatch('open-slide-panel', { component: 'create-task', title: 'Create New Task' })"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Task
            </button>
        </div>
    </x-slot>

    <div x-data="{ view: 'board' }">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Tasks</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">48</p>
                    </div>
                    <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">In Progress</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">18</p>
                    </div>
                    <div class="w-10 h-10 bg-warning-100 dark:bg-warning-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-warning-600 dark:text-warning-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Completed</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">24</p>
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
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Overdue</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">6</p>
                    </div>
                    <div class="w-10 h-10 bg-danger-100 dark:bg-danger-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-danger-600 dark:text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanban Board View -->
        <div x-show="view === 'board'" class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- To Do Column -->
            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white flex items-center">
                        <span class="w-2 h-2 bg-gray-400 rounded-full mr-2"></span>
                        To Do
                        <span class="ml-2 px-2 py-0.5 text-xs font-medium bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full">6</span>
                    </h3>
                    <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-3">
                    <!-- Task Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow cursor-pointer">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Follow up with Sarah Johnson</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Contact lead regarding Lekki property viewing</p>
                        <div class="flex items-center justify-between">
                            <span class="px-2 py-1 text-xs font-medium bg-warning-100 dark:bg-warning-900 text-warning-800 dark:text-warning-200 rounded">High</span>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Due: Today</span>
                                <div class="w-6 h-6 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                    JA
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow cursor-pointer">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Update property listings</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Add new photos and update descriptions</p>
                        <div class="flex items-center justify-between">
                            <span class="px-2 py-1 text-xs font-medium bg-secondary-100 dark:bg-secondary-900 text-secondary-800 dark:text-secondary-200 rounded">Medium</span>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Due: Tomorrow</span>
                                <div class="w-6 h-6 bg-gradient-to-br from-success-500 to-success-600 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                    AO
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- In Progress Column -->
            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white flex items-center">
                        <span class="w-2 h-2 bg-warning-400 rounded-full mr-2"></span>
                        In Progress
                        <span class="ml-2 px-2 py-0.5 text-xs font-medium bg-warning-100 dark:bg-warning-900 text-warning-700 dark:text-warning-300 rounded-full">18</span>
                    </h3>
                    <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-3">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow cursor-pointer">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Prepare contract documents</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Victoria Island apartment sale to TechCorp</p>
                        <div class="flex items-center justify-between">
                            <span class="px-2 py-1 text-xs font-medium bg-danger-100 dark:bg-danger-900 text-danger-800 dark:text-danger-200 rounded">Urgent</span>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Due: Today</span>
                                <div class="w-6 h-6 bg-gradient-to-br from-warning-500 to-warning-600 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                    TB
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow cursor-pointer">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Property inspection schedule</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Coordinate with 3 clients for Ikoyi Estate</p>
                        <div class="flex items-center justify-between">
                            <span class="px-2 py-1 text-xs font-medium bg-secondary-100 dark:bg-secondary-900 text-secondary-800 dark:text-secondary-200 rounded">Medium</span>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Due: 2 days</span>
                                <div class="w-6 h-6 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                    JA
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review Column -->
            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white flex items-center">
                        <span class="w-2 h-2 bg-primary-400 rounded-full mr-2"></span>
                        Review
                        <span class="ml-2 px-2 py-0.5 text-xs font-medium bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300 rounded-full">12</span>
                    </h3>
                    <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-3">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow cursor-pointer">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Marketing flyer approval</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Review designs for Lekki Phase 1 campaign</p>
                        <div class="flex items-center justify-between">
                            <span class="px-2 py-1 text-xs font-medium bg-primary-100 dark:bg-primary-900 text-primary-800 dark:text-primary-200 rounded">Low</span>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Due: 3 days</span>
                                <div class="w-6 h-6 bg-gradient-to-br from-success-500 to-success-600 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                    AO
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Done Column -->
            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white flex items-center">
                        <span class="w-2 h-2 bg-success-400 rounded-full mr-2"></span>
                        Done
                        <span class="ml-2 px-2 py-0.5 text-xs font-medium bg-success-100 dark:bg-success-900 text-success-700 dark:text-success-300 rounded-full">24</span>
                    </h3>
                    <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-3">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow cursor-pointer opacity-75">
                        <div class="flex items-center mb-2">
                            <svg class="w-4 h-4 text-success-600 dark:text-success-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white line-through">Client meeting completed</h4>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Met with Oluwaseun regarding new property</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Completed today</span>
                            <div class="w-6 h-6 bg-gradient-to-br from-warning-500 to-warning-600 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                TB
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow cursor-pointer opacity-75">
                        <div class="flex items-center mb-2">
                            <svg class="w-4 h-4 text-success-600 dark:text-success-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white line-through">Submit monthly report</h4>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Sales performance for November 2024</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Completed yesterday</span>
                            <div class="w-6 h-6 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                JA
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- List View -->
        <div x-show="view === 'list'" x-cloak>
            <x-agency.data-table :headers="['Task', 'Assigned To', 'Priority', 'Status', 'Due Date']">
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="px-6 py-4">
                        <div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">Follow up with Sarah Johnson</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Contact lead regarding Lekki property viewing</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                JA
                            </div>
                            <span class="ml-2 text-sm text-gray-900 dark:text-white">John A.</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-warning-100 dark:bg-warning-900 text-warning-800 dark:text-warning-200 rounded">High</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded">To Do</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">Today</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-primary-600 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
            </x-agency.data-table>
        </div>
    </div>
</x-layouts.agency>
