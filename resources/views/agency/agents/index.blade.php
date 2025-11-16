@extends('layouts.app')

@section('title', 'Agents')
@section('page-title', 'Agent Management')

@section('navigation')
    <a href="{{ route('dashboard') }}" class="flex items-center rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Dashboard</span>
    </a>
    <a href="{{ route('agency.properties.index') }}" class="flex items-center rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Properties</span>
    </a>
    <a href="{{ route('agency.agents.index') }}" class="flex items-center rounded-lg transition-colors bg-primary-50 text-primary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Agents</span>
    </a>
    <a href="{{ route('agency.reports.index') }}" class="flex items-center rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Reports</span>
    </a>
@endsection

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-secondary-900 dark:text-white">Team Agents</h1>
            <p class="mt-1 text-sm text-secondary-600 dark:text-secondary-400">Manage your real estate agents and their performance</p>
        </div>
        <button @click="$dispatch('open-slideout', { title: 'Add New Agent', description: 'Invite a new agent to your agency' }); currentSlideout = 'add-agent'"
                class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            Add Agent
        </button>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Total Agents</p>
                    <p class="text-2xl font-bold text-secondary-900 dark:text-white mt-1">12</p>
                </div>
                <div class="bg-primary-100 dark:bg-primary-900 rounded-lg p-3">
                    <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Active</p>
                    <p class="text-2xl font-bold text-secondary-900 dark:text-white mt-1">10</p>
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
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Top Performer</p>
                    <p class="text-2xl font-bold text-secondary-900 dark:text-white mt-1">Sarah J.</p>
                </div>
                <div class="bg-warning-100 dark:bg-warning-900 rounded-lg p-3">
                    <svg class="w-5 h-5 text-warning-600 dark:text-warning-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Avg. Commission</p>
                    <p class="text-2xl font-bold text-secondary-900 dark:text-white mt-1">2.5%</p>
                </div>
                <div class="bg-secondary-100 dark:bg-secondary-700 rounded-lg p-3">
                    <svg class="w-5 h-5 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                    <input type="text" placeholder="Search agents..."
                           class="w-full pl-10 pr-4 py-2.5 bg-secondary-50 dark:bg-secondary-900 border border-secondary-200 dark:border-secondary-700 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors">
                    <svg class="absolute left-3 top-3 w-5 h-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <select class="px-4 py-2.5 bg-secondary-50 dark:bg-secondary-900 border border-secondary-200 dark:border-secondary-700 rounded-lg text-secondary-900 dark:text-white focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="pending">Pending</option>
                </select>
                <select class="px-4 py-2.5 bg-secondary-50 dark:bg-secondary-900 border border-secondary-200 dark:border-secondary-700 rounded-lg text-secondary-900 dark:text-white focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors">
                    <option value="">Sort By</option>
                    <option value="name">Name</option>
                    <option value="sales">Sales</option>
                    <option value="commission">Commission</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Agents Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Agent Card 1 -->
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center">
                            <span class="text-lg font-bold text-primary-600 dark:text-primary-400">JS</span>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-secondary-900 dark:text-white">John Smith</h3>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Senior Agent</p>
                        </div>
                    </div>
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-success-100 dark:bg-success-900 text-success-800 dark:text-success-200">
                        Active
                    </span>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center text-sm text-secondary-600 dark:text-secondary-400">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        john.smith@example.com
                    </div>
                    <div class="flex items-center text-sm text-secondary-600 dark:text-secondary-400">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +1 (555) 123-4567
                    </div>
                    <div class="flex items-center text-sm text-secondary-600 dark:text-secondary-400">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        License: RE-123456
                    </div>
                </div>

                <div class="border-t border-secondary-200 dark:border-secondary-700 pt-4">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Properties</p>
                            <p class="text-lg font-bold text-secondary-900 dark:text-white">8</p>
                        </div>
                        <div>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Sales</p>
                            <p class="text-lg font-bold text-secondary-900 dark:text-white">$2.4M</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-secondary-600 dark:text-secondary-400">Commission: 2.5%</span>
                        <button class="text-sm text-primary-600 hover:text-primary-700 font-medium">View Details</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Agent Card 2 -->
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-full bg-success-100 dark:bg-success-900 flex items-center justify-center">
                            <span class="text-lg font-bold text-success-600 dark:text-success-400">SJ</span>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-secondary-900 dark:text-white">Sarah Johnson</h3>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Top Agent</p>
                        </div>
                    </div>
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-success-100 dark:bg-success-900 text-success-800 dark:text-success-200">
                        Active
                    </span>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center text-sm text-secondary-600 dark:text-secondary-400">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        sarah.j@example.com
                    </div>
                    <div class="flex items-center text-sm text-secondary-600 dark:text-secondary-400">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +1 (555) 987-6543
                    </div>
                    <div class="flex items-center text-sm text-secondary-600 dark:text-secondary-400">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        License: RE-789012
                    </div>
                </div>

                <div class="border-t border-secondary-200 dark:border-secondary-700 pt-4">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Properties</p>
                            <p class="text-lg font-bold text-secondary-900 dark:text-white">12</p>
                        </div>
                        <div>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Sales</p>
                            <p class="text-lg font-bold text-secondary-900 dark:text-white">$3.8M</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-secondary-600 dark:text-secondary-400">Commission: 3.0%</span>
                        <button class="text-sm text-primary-600 hover:text-primary-700 font-medium">View Details</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Agent Card 3 -->
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-full bg-warning-100 dark:bg-warning-900 flex items-center justify-center">
                            <span class="text-lg font-bold text-warning-600 dark:text-warning-400">MD</span>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-secondary-900 dark:text-white">Mike Davis</h3>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Agent</p>
                        </div>
                    </div>
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-warning-100 dark:bg-warning-900 text-warning-800 dark:text-warning-200">
                        Pending
                    </span>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center text-sm text-secondary-600 dark:text-secondary-400">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        mike.davis@example.com
                    </div>
                    <div class="flex items-center text-sm text-secondary-600 dark:text-secondary-400">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +1 (555) 456-7890
                    </div>
                    <div class="flex items-center text-sm text-secondary-600 dark:text-secondary-400">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        License: RE-345678
                    </div>
                </div>

                <div class="border-t border-secondary-200 dark:border-secondary-700 pt-4">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Properties</p>
                            <p class="text-lg font-bold text-secondary-900 dark:text-white">3</p>
                        </div>
                        <div>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">Sales</p>
                            <p class="text-lg font-bold text-secondary-900 dark:text-white">$890K</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-secondary-600 dark:text-secondary-400">Commission: 2.0%</span>
                        <button class="text-sm text-primary-600 hover:text-primary-700 font-medium">View Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('slideouts')
    <!-- Add Agent Form (same as in dashboard) -->
    <div x-show="currentSlideout === 'add-agent'" x-cloak>
        <form action="{{ route('agency.users.store') }}" method="POST" class="h-full flex flex-col">
            @csrf
            <input type="hidden" name="role" value="realtor">

            <!-- Form Content (Scrollable) -->
            <div class="flex-1 overflow-y-auto px-6 py-6 space-y-6">
                <!-- Agent Information -->
                <div>
                    <h3 class="text-sm font-semibold text-secondary-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Agent Information
                    </h3>
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Full Name -->
                        <div>
                            <label for="agent_name" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Full Name <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" name="name" id="agent_name" required
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="John Smith">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="agent_email" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Email Address <span class="text-danger-600">*</span>
                            </label>
                            <input type="email" name="email" id="agent_email" required
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="john.smith@example.com">
                            <p class="mt-1.5 text-xs text-secondary-500 dark:text-secondary-400">Agent will receive an invitation email to set their password</p>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="agent_phone" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Phone Number
                            </label>
                            <input type="tel" name="phone" id="agent_phone"
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="+1234567890">
                        </div>

                        <!-- License Number -->
                        <div>
                            <label for="license_number" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                License Number
                            </label>
                            <input type="text" name="license_number" id="license_number"
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="RE-123456">
                        </div>

                        <!-- Commission Rate -->
                        <div>
                            <label for="commission_rate" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Commission Rate (%)
                            </label>
                            <input type="number" name="commission_rate" id="commission_rate" step="0.01" min="0" max="100"
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="2.5">
                            <p class="mt-1.5 text-xs text-secondary-500 dark:text-secondary-400">Percentage of sale/rent commission</p>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        <span>Send Invitation</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
