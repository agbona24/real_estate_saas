@extends('layouts.app')

@section('title', 'Reports')
@section('page-title', 'Reports & Analytics')

@section('navigation')
    @include('agency.partials.navigation')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-secondary-900 dark:text-white">Reports & Analytics</h1>
            <p class="mt-1 text-sm text-secondary-600 dark:text-secondary-400">Track your agency's performance and insights</p>
        </div>
        <div class="mt-4 sm:mt-0 flex items-center gap-3">
            <select class="px-4 py-2.5 bg-white dark:bg-secondary-800 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors">
                <option value="7">Last 7 Days</option>
                <option value="30" selected>Last 30 Days</option>
                <option value="90">Last 90 Days</option>
                <option value="365">Last Year</option>
            </select>
            <button class="inline-flex items-center px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export Report
            </button>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-primary-100 dark:bg-primary-900 rounded-lg p-3">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Total Revenue</p>
                    <p class="text-2xl font-bold text-secondary-900 dark:text-white mt-1">$1.2M</p>
                    <p class="text-sm text-success-600 mt-1">
                        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        +15% vs last month
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-success-100 dark:bg-success-900 rounded-lg p-3">
                    <svg class="w-6 h-6 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Deals Closed</p>
                    <p class="text-2xl font-bold text-secondary-900 dark:text-white mt-1">18</p>
                    <p class="text-sm text-success-600 mt-1">
                        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        +3 this month
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-warning-100 dark:bg-warning-900 rounded-lg p-3">
                    <svg class="w-6 h-6 text-warning-600 dark:text-warning-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Avg. Deal Time</p>
                    <p class="text-2xl font-bold text-secondary-900 dark:text-white mt-1">24 days</p>
                    <p class="text-sm text-success-600 mt-1">
                        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        -3 days faster
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-secondary-100 dark:bg-secondary-700 rounded-lg p-3">
                    <svg class="w-6 h-6 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Conversion Rate</p>
                    <p class="text-2xl font-bold text-secondary-900 dark:text-white mt-1">42%</p>
                    <p class="text-sm text-success-600 mt-1">
                        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        +5% increase
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Revenue Chart -->
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-secondary-900 dark:text-white">Revenue Trend</h3>
                <select class="px-3 py-1.5 bg-secondary-50 dark:bg-secondary-900 border border-secondary-200 dark:border-secondary-700 rounded-lg text-sm text-secondary-900 dark:text-white">
                    <option>Monthly</option>
                    <option>Quarterly</option>
                    <option>Yearly</option>
                </select>
            </div>
            <div class="h-64 flex items-center justify-center bg-secondary-50 dark:bg-secondary-900 rounded-lg">
                <div class="text-center">
                    <svg class="w-16 h-16 text-secondary-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                    <p class="text-sm text-secondary-500 dark:text-secondary-400">Chart placeholder</p>
                    <p class="text-xs text-secondary-400 mt-1">Revenue chart will be displayed here</p>
                </div>
            </div>
        </div>

        <!-- Sales Pipeline -->
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-secondary-900 dark:text-white">Sales Pipeline</h3>
                <button class="text-sm text-primary-600 hover:text-primary-700 font-medium">View All</button>
            </div>
            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-secondary-900 dark:text-white">New Leads</span>
                        <span class="text-sm text-secondary-600 dark:text-secondary-400">34 deals</span>
                    </div>
                    <div class="w-full bg-secondary-200 dark:bg-secondary-700 rounded-full h-2">
                        <div class="bg-primary-600 h-2 rounded-full" style="width: 68%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-secondary-900 dark:text-white">Contacted</span>
                        <span class="text-sm text-secondary-600 dark:text-secondary-400">28 deals</span>
                    </div>
                    <div class="w-full bg-secondary-200 dark:bg-secondary-700 rounded-full h-2">
                        <div class="bg-success-600 h-2 rounded-full" style="width: 56%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-secondary-900 dark:text-white">Qualified</span>
                        <span class="text-sm text-secondary-600 dark:text-secondary-400">21 deals</span>
                    </div>
                    <div class="w-full bg-secondary-200 dark:bg-secondary-700 rounded-full h-2">
                        <div class="bg-warning-500 h-2 rounded-full" style="width: 42%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-secondary-900 dark:text-white">Proposal Sent</span>
                        <span class="text-sm text-secondary-600 dark:text-secondary-400">15 deals</span>
                    </div>
                    <div class="w-full bg-secondary-200 dark:bg-secondary-700 rounded-full h-2">
                        <div class="bg-info-600 h-2 rounded-full" style="width: 30%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-secondary-900 dark:text-white">Negotiation</span>
                        <span class="text-sm text-secondary-600 dark:text-secondary-400">8 deals</span>
                    </div>
                    <div class="w-full bg-secondary-200 dark:bg-secondary-700 rounded-full h-2">
                        <div class="bg-purple-600 h-2 rounded-full" style="width: 16%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agent Performance & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Performing Agents -->
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-secondary-900 dark:text-white">Top Performing Agents</h3>
                <button class="text-sm text-primary-600 hover:text-primary-700 font-medium">View All</button>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-secondary-50 dark:bg-secondary-900 rounded-lg">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-success-100 dark:bg-success-900 flex items-center justify-center">
                            <span class="text-sm font-bold text-success-600 dark:text-success-400">SJ</span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-secondary-900 dark:text-white">Sarah Johnson</p>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">12 deals closed</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-secondary-900 dark:text-white">$3.8M</p>
                        <p class="text-xs text-success-600">+24%</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-secondary-50 dark:bg-secondary-900 rounded-lg">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center">
                            <span class="text-sm font-bold text-primary-600 dark:text-primary-400">JS</span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-secondary-900 dark:text-white">John Smith</p>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">8 deals closed</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-secondary-900 dark:text-white">$2.4M</p>
                        <p class="text-xs text-success-600">+18%</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-secondary-50 dark:bg-secondary-900 rounded-lg">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-warning-100 dark:bg-warning-900 flex items-center justify-center">
                            <span class="text-sm font-bold text-warning-600 dark:text-warning-400">MD</span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-secondary-900 dark:text-white">Mike Davis</p>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">5 deals closed</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-secondary-900 dark:text-white">$1.5M</p>
                        <p class="text-xs text-success-600">+12%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Property Categories Performance -->
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-secondary-900 dark:text-white">Property Categories</h3>
                <button class="text-sm text-primary-600 hover:text-primary-700 font-medium">Details</button>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-lg bg-primary-100 dark:bg-primary-900 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-secondary-900 dark:text-white">Houses</p>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">8 sold this month</p>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-secondary-900 dark:text-white">$4.2M</p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-lg bg-success-100 dark:bg-success-900 flex items-center justify-center">
                            <svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-secondary-900 dark:text-white">Apartments</p>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">6 sold this month</p>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-secondary-900 dark:text-white">$2.8M</p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-lg bg-warning-100 dark:bg-warning-900 flex items-center justify-center">
                            <svg class="w-5 h-5 text-warning-600 dark:text-warning-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-secondary-900 dark:text-white">Commercial</p>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">3 sold this month</p>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-secondary-900 dark:text-white">$1.5M</p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-lg bg-secondary-100 dark:bg-secondary-700 flex items-center justify-center">
                            <svg class="w-5 h-5 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-secondary-900 dark:text-white">Land</p>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">2 sold this month</p>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-secondary-900 dark:text-white">$890K</p>
                </div>
            </div>
        </div>
    </div>
@endsection
