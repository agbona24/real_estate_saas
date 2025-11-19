<x-layouts.agency>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Appointments & Viewings</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage property viewings, client meetings, and appointments</p>
            </div>
            <div class="flex items-center space-x-3">
                <select class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                    <option value="week">Week View</option>
                    <option value="month" selected>Month View</option>
                    <option value="day">Day View</option>
                    <option value="list">List View</option>
                </select>
                <button
                    @click="$dispatch('open-slide-panel', {
                        title: 'Schedule New Appointment',
                        component: 'agency.forms.create-appointment'
                    })"
                    class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Appointment
                </button>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Today's Appointments -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Today</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-white">8</p>
                    </div>
                </div>
            </div>

            <!-- This Week -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">This Week</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-white">32</p>
                    </div>
                </div>
            </div>

            <!-- Confirmed -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Confirmed</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-white">24</p>
                    </div>
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Pending</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-white">8</p>
                    </div>
                </div>
            </div>

            <!-- Completed -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Completed</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-white">156</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Calendar -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">November 2024</h3>
                            <div class="flex items-center space-x-2">
                                <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <button class="px-3 py-1 text-sm font-medium text-primary-600 dark:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900 rounded-lg">
                                    Today
                                </button>
                                <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <!-- Calendar Grid -->
                        <div class="grid grid-cols-7 gap-2">
                            <!-- Day Headers -->
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 py-2">Sun</div>
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 py-2">Mon</div>
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 py-2">Tue</div>
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 py-2">Wed</div>
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 py-2">Thu</div>
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 py-2">Fri</div>
                            <div class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400 py-2">Sat</div>

                            <!-- Calendar Days -->
                            <!-- Week 1 -->
                            <div class="aspect-square p-2 text-sm text-gray-400 dark:text-gray-600">27</div>
                            <div class="aspect-square p-2 text-sm text-gray-400 dark:text-gray-600">28</div>
                            <div class="aspect-square p-2 text-sm text-gray-400 dark:text-gray-600">29</div>
                            <div class="aspect-square p-2 text-sm text-gray-400 dark:text-gray-600">30</div>
                            <div class="aspect-square p-2 text-sm text-gray-400 dark:text-gray-600">31</div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">1</div>
                                <div class="mt-1 space-y-0.5">
                                    <div class="h-1 bg-primary-500 rounded"></div>
                                </div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">2</div>
                            </div>

                            <!-- Week 2 -->
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">3</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">4</div>
                                <div class="mt-1 space-y-0.5">
                                    <div class="h-1 bg-green-500 rounded"></div>
                                    <div class="h-1 bg-blue-500 rounded"></div>
                                </div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">5</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">6</div>
                                <div class="mt-1 space-y-0.5">
                                    <div class="h-1 bg-yellow-500 rounded"></div>
                                </div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">7</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">8</div>
                                <div class="mt-1 space-y-0.5">
                                    <div class="h-1 bg-primary-500 rounded"></div>
                                </div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">9</div>
                            </div>

                            <!-- Week 3 -->
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">10</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">11</div>
                                <div class="mt-1 space-y-0.5">
                                    <div class="h-1 bg-green-500 rounded"></div>
                                </div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">12</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">13</div>
                                <div class="mt-1 space-y-0.5">
                                    <div class="h-1 bg-primary-500 rounded"></div>
                                    <div class="h-1 bg-yellow-500 rounded"></div>
                                </div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">14</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">15</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">16</div>
                            </div>

                            <!-- Week 4 -->
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">17</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">18</div>
                                <div class="mt-1 space-y-0.5">
                                    <div class="h-1 bg-blue-500 rounded"></div>
                                </div>
                            </div>
                            <div class="aspect-square p-2 border-2 border-primary-500 bg-primary-50 dark:bg-primary-900 rounded-lg cursor-pointer">
                                <div class="text-sm font-semibold text-primary-600 dark:text-primary-400">19</div>
                                <div class="mt-1 space-y-0.5">
                                    <div class="h-1 bg-primary-500 rounded"></div>
                                    <div class="h-1 bg-green-500 rounded"></div>
                                    <div class="h-1 bg-yellow-500 rounded"></div>
                                </div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">20</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">21</div>
                                <div class="mt-1 space-y-0.5">
                                    <div class="h-1 bg-primary-500 rounded"></div>
                                </div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">22</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">23</div>
                            </div>

                            <!-- Week 5 -->
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">24</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">25</div>
                                <div class="mt-1 space-y-0.5">
                                    <div class="h-1 bg-green-500 rounded"></div>
                                </div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">26</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">27</div>
                                <div class="mt-1 space-y-0.5">
                                    <div class="h-1 bg-primary-500 rounded"></div>
                                    <div class="h-1 bg-blue-500 rounded"></div>
                                </div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">28</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">29</div>
                            </div>
                            <div class="aspect-square p-2 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">30</div>
                            </div>
                        </div>

                        <!-- Color Legend -->
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex flex-wrap items-center gap-4 text-xs">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-primary-500 rounded mr-2"></div>
                                    <span class="text-gray-600 dark:text-gray-400">Property Viewing</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded mr-2"></div>
                                    <span class="text-gray-600 dark:text-gray-400">Client Meeting</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-blue-500 rounded mr-2"></div>
                                    <span class="text-gray-600 dark:text-gray-400">Site Visit</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-500 rounded mr-2"></div>
                                    <span class="text-gray-600 dark:text-gray-400">Follow-up</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Schedule -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Today's Schedule</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Tuesday, November 19</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <!-- Appointment 1 -->
                            <div class="flex space-x-3">
                                <div class="flex-shrink-0 w-12 text-center">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">09:00</div>
                                </div>
                                <div class="flex-1 bg-primary-50 dark:bg-primary-900 rounded-lg p-3 border-l-4 border-primary-500">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Property Viewing</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">3BR Apartment, Lekki</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Mr. Adebayo Johnson</p>
                                        </div>
                                    </div>
                                    <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        45 mins
                                    </div>
                                </div>
                            </div>

                            <!-- Appointment 2 -->
                            <div class="flex space-x-3">
                                <div class="flex-shrink-0 w-12 text-center">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">10:30</div>
                                </div>
                                <div class="flex-1 bg-green-50 dark:bg-green-900 rounded-lg p-3 border-l-4 border-green-500">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Client Meeting</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Discuss investment options</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Mrs. Fatima Ibrahim</p>
                                        </div>
                                    </div>
                                    <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        1 hour
                                    </div>
                                </div>
                            </div>

                            <!-- Appointment 3 -->
                            <div class="flex space-x-3">
                                <div class="flex-shrink-0 w-12 text-center">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">14:00</div>
                                </div>
                                <div class="flex-1 bg-blue-50 dark:bg-blue-900 rounded-lg p-3 border-l-4 border-blue-500">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Site Visit</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Lekki Gardens Estate</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Multiple clients</p>
                                        </div>
                                    </div>
                                    <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        2 hours
                                    </div>
                                </div>
                            </div>

                            <!-- Appointment 4 -->
                            <div class="flex space-x-3">
                                <div class="flex-shrink-0 w-12 text-center">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">16:30</div>
                                </div>
                                <div class="flex-1 bg-yellow-50 dark:bg-yellow-900 rounded-lg p-3 border-l-4 border-yellow-500">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Follow-up Call</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Negotiation discussion</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Chief Okonkwo</p>
                                        </div>
                                    </div>
                                    <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        30 mins
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button class="w-full px-4 py-2 text-sm font-medium text-primary-600 dark:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900 rounded-lg transition-colors">
                                View Full Schedule
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Appointments List -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Upcoming Appointments</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date & Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Property/Topic</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Agent</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Nov 20, 10:00 AM</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-primary-100 dark:bg-primary-900 text-primary-800 dark:text-primary-200 rounded-full">
                                    Viewing
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 dark:text-white">4BR Duplex</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Lekki Phase 1</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">Mr. Charles Okeke</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="https://ui-avatars.com/api/?name=John+Adeleke&background=FF2D20&color=fff" alt="Agent" class="w-6 h-6 rounded-full mr-2">
                                    <div class="text-sm text-gray-900 dark:text-white">John Adeleke</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full">
                                    Confirmed
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300 mr-3">
                                    View
                                </button>
                                <button class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    Edit
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Nov 21, 2:30 PM</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full">
                                    Meeting
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 dark:text-white">Contract Signing</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Victoria Island property</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">Mrs. Blessing Eze</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="https://ui-avatars.com/api/?name=Aisha+Okonkwo&background=FF2D20&color=fff" alt="Agent" class="w-6 h-6 rounded-full mr-2">
                                    <div class="text-sm text-gray-900 dark:text-white">Aisha Okonkwo</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full">
                                    Pending
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300 mr-3">
                                    View
                                </button>
                                <button class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.agency>
