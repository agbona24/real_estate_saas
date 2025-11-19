<x-layouts.agency>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Reports & Analytics</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Comprehensive insights into your agency's performance</p>
            </div>
            <div class="flex items-center space-x-3">
                <select class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                    <option value="7">Last 7 Days</option>
                    <option value="30" selected>Last 30 Days</option>
                    <option value="90">Last 90 Days</option>
                    <option value="365">Last Year</option>
                    <option value="custom">Custom Range</option>
                </select>
                <button class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export Report
                </button>
            </div>
        </div>

        <!-- Key Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Revenue -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Total Revenue</p>
                        <p class="text-3xl font-bold mt-2">₦4.2B</p>
                        <div class="flex items-center mt-2">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm">+18.2% from last month</span>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Properties Sold -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Properties Sold</p>
                        <p class="text-3xl font-bold mt-2">127</p>
                        <div class="flex items-center mt-2">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm">+12.5% from last month</span>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Leads -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Active Leads</p>
                        <p class="text-3xl font-bold mt-2">284</p>
                        <div class="flex items-center mt-2">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm">+8.3% from last month</span>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Conversion Rate -->
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">Conversion Rate</p>
                        <p class="text-3xl font-bold mt-2">34.8%</p>
                        <div class="flex items-center mt-2">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm">+3.2% from last month</span>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Revenue Trend Chart -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Revenue Trend</h3>
                        <select class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="monthly">Monthly</option>
                            <option value="weekly">Weekly</option>
                            <option value="daily">Daily</option>
                        </select>
                    </div>
                </div>
                <div class="p-6">
                    <!-- Placeholder for Chart -->
                    <div class="h-64 flex items-center justify-center bg-gray-50 dark:bg-gray-900 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                            </svg>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Revenue Chart</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Chart.js or ApexCharts integration</p>
                        </div>
                    </div>
                    <!-- Sample Data Points -->
                    <div class="mt-4 grid grid-cols-6 gap-2">
                        <div class="text-center">
                            <div class="text-xs text-gray-500 dark:text-gray-400">Jun</div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">₦650M</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xs text-gray-500 dark:text-gray-400">Jul</div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">₦720M</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xs text-gray-500 dark:text-gray-400">Aug</div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">₦580M</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xs text-gray-500 dark:text-gray-400">Sep</div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">₦890M</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xs text-gray-500 dark:text-gray-400">Oct</div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">₦1.1B</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xs text-gray-500 dark:text-gray-400">Nov</div>
                            <div class="text-sm font-semibold text-primary-600 dark:text-primary-400">₦1.3B</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales by Property Type -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Sales by Property Type</h3>
                </div>
                <div class="p-6">
                    <!-- Placeholder for Pie/Donut Chart -->
                    <div class="h-64 flex items-center justify-center">
                        <div class="relative">
                            <!-- Simple visual representation -->
                            <div class="w-48 h-48 rounded-full border-8 border-primary-500 flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-gray-900 dark:text-white">127</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Sales</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Property Type Breakdown -->
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-primary-500 rounded-full mr-2"></div>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Residential</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">68 (53.5%)</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Commercial</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">32 (25.2%)</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Land</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">18 (14.2%)</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Mixed Use</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">9 (7.1%)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Agent Performance & Property Inventory -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top Performing Agents -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Top Performing Agents</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- Agent 1 -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=John+Adeleke&background=FF2D20&color=fff" alt="Agent" class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">John Adeleke</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">42 deals closed</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900 dark:text-white">₦1.2B</div>
                                <div class="text-xs text-green-600 dark:text-green-400">+24.5%</div>
                            </div>
                        </div>

                        <!-- Agent 2 -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=Aisha+Okonkwo&background=FF2D20&color=fff" alt="Agent" class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Aisha Okonkwo</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">38 deals closed</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900 dark:text-white">₦980M</div>
                                <div class="text-xs text-green-600 dark:text-green-400">+18.2%</div>
                            </div>
                        </div>

                        <!-- Agent 3 -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=Tunde+Bello&background=FF2D20&color=fff" alt="Agent" class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Tunde Bello</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">31 deals closed</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900 dark:text-white">₦820M</div>
                                <div class="text-xs text-green-600 dark:text-green-400">+15.8%</div>
                            </div>
                        </div>

                        <!-- Agent 4 -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=Chioma+Nwankwo&background=FF2D20&color=fff" alt="Agent" class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Chioma Nwankwo</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">16 deals closed</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900 dark:text-white">₦580M</div>
                                <div class="text-xs text-green-600 dark:text-green-400">+12.3%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Inventory Status -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Property Inventory Status</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- Available -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Available</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">142 properties</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 65%"></div>
                            </div>
                        </div>

                        <!-- Under Offer -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Under Offer</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">38 properties</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full" style="width: 17%"></div>
                            </div>
                        </div>

                        <!-- Reserved -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Reserved</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">24 properties</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-orange-500 h-2 rounded-full" style="width: 11%"></div>
                            </div>
                        </div>

                        <!-- Sold -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Sold (This Month)</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">24 properties</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-primary-500 h-2 rounded-full" style="width: 11%"></div>
                            </div>
                        </div>

                        <!-- Off Market -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Off Market</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">8 properties</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gray-500 h-2 rounded-full" style="width: 4%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Total Inventory</span>
                            <span class="text-lg font-bold text-gray-900 dark:text-white">236 properties</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lead Source Analysis -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Lead Source Performance</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Website -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full mb-3">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">124</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Website</div>
                        <div class="text-xs text-green-600 dark:text-green-400 mt-1">38% conversion</div>
                    </div>

                    <!-- Referrals -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full mb-3">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">87</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Referrals</div>
                        <div class="text-xs text-green-600 dark:text-green-400 mt-1">52% conversion</div>
                    </div>

                    <!-- Social Media -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full mb-3">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">63</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Social Media</div>
                        <div class="text-xs text-yellow-600 dark:text-yellow-400 mt-1">28% conversion</div>
                    </div>

                    <!-- Walk-in -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-100 dark:bg-orange-900 rounded-full mb-3">
                            <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">42</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Walk-in</div>
                        <div class="text-xs text-green-600 dark:text-green-400 mt-1">45% conversion</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.agency>
