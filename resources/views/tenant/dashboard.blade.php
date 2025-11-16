@extends('layouts.app')

@section('title', 'Agency Dashboard')
@section('page-title', 'Agency Admin Dashboard')

@section('navigation')
    <a href="{{ route('dashboard') }}" class="flex items-center rounded-lg transition-colors bg-primary-50 text-primary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Dashboard</span>
    </a>
    <a href="{{ route('tenant.properties.index') }}" class="flex items-center rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Properties</span>
    </a>
    <a href="{{ route('tenant.leads.index') }}" class="flex items-center rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Leads</span>
    </a>
    <a href="{{ route('tenant.clients.index') }}" class="flex items-center rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Clients</span>
    </a>
    <a href="{{ route('tenant.estates.index') }}" class="flex items-center rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Estates</span>
    </a>
    <a href="{{ route('tenant.realtors.index') }}" class="flex items-center rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Agents</span>
    </a>
    <a href="{{ route('tenant.transactions.index') }}" class="flex items-center rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Transactions</span>
    </a>
    <a href="{{ route('tenant.payments.schedule') }}" class="flex items-center rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Payments</span>
    </a>
    <a href="{{ route('tenant.website.builder') }}" class="flex items-center rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Website</span>
    </a>
    <a href="{{ route('tenant.subscription.index') }}" class="flex items-center rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
        <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Subscription</span>
    </a>
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Total Properties</p>
                    <p class="text-3xl font-bold text-secondary-900 dark:text-white mt-2">{{ $stats['total_properties'] }}</p>
                    <p class="text-sm text-primary-600 mt-1">
                        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                        {{ $stats['new_properties_this_month'] }} added this month
                    </p>
                </div>
                <div class="bg-primary-100 dark:bg-primary-900 rounded-full p-4">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Active Agents</p>
                    <p class="text-3xl font-bold text-secondary-900 dark:text-white mt-2">{{ $stats['active_agents'] }}</p>
                    <p class="text-sm text-success-600 mt-1">
                        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        All active
                    </p>
                </div>
                <div class="bg-success-100 dark:bg-success-900 rounded-full p-4">
                    <svg class="w-6 h-6 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Monthly Revenue</p>
                    <p class="text-3xl font-bold text-secondary-900 dark:text-white mt-2">$48.5K</p>
                    <p class="text-sm text-secondary-600 dark:text-secondary-400 mt-1">+15% vs last month</p>
                </div>
                <div class="bg-secondary-100 dark:bg-secondary-700 rounded-full p-4">
                    <svg class="w-6 h-6 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Active Deals</p>
                    <p class="text-3xl font-bold text-secondary-900 dark:text-white mt-2">{{ $stats['active_deals'] }}</p>
                    <p class="text-sm text-secondary-600 dark:text-secondary-400 mt-1">In progress</p>
                </div>
                <div class="bg-warning-100 dark:bg-warning-900 rounded-full p-4">
                    <svg class="w-6 h-6 text-warning-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-secondary-800 rounded-xl shadow-soft border border-secondary-100 dark:border-secondary-700 p-6">
        <h3 class="text-lg font-bold text-secondary-900 dark:text-white mb-4">
            <svg class="w-5 h-5 text-warning-500 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
            Quick Actions
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="{{ route('tenant.properties.create') }}" class="flex items-center justify-center space-x-2 bg-primary-600 hover:bg-primary-700 text-white px-6 py-4 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                <span>Add Property</span>
            </a>
            <a href="{{ route('tenant.realtors.create') }}" class="flex items-center justify-center space-x-2 bg-secondary-100 dark:bg-secondary-700 text-secondary-900 dark:text-white hover:bg-secondary-200 dark:hover:bg-secondary-600 px-6 py-4 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                <span>Add Agent</span>
            </a>
            <a href="{{ route('tenant.leads.create') }}" class="flex items-center justify-center space-x-2 bg-secondary-100 dark:bg-secondary-700 text-secondary-900 dark:text-white hover:bg-secondary-200 dark:hover:bg-secondary-600 px-6 py-4 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                <span>Add Lead</span>
            </a>
            <a href="{{ route('tenant.transactions.index') }}" class="flex items-center justify-center space-x-2 bg-secondary-100 dark:bg-secondary-700 text-secondary-900 dark:text-white hover:bg-secondary-200 dark:hover:bg-secondary-600 px-6 py-4 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                <span>View Transactions</span>
            </a>
        </div>
    </div>
@endsection
