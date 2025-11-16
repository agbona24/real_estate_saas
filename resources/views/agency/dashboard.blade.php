@extends('layouts.app')

@section('title', 'Agency Dashboard')
@section('page-title', 'Agency Admin Dashboard')

@section('navigation')
    <div x-data="{
        openMenus: ['dashboard'],
        toggleMenu(menu) {
            if (this.openMenus.includes(menu)) {
                this.openMenus = this.openMenus.filter(m => m !== menu);
            } else {
                this.openMenus.push(menu);
            }
        }
    }">
        <!-- Dashboard (Single Link) -->
        <a href="{{ route('dashboard') }}" class="flex items-center rounded-lg transition-colors bg-primary-50 text-primary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
            <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Dashboard</span>
        </a>

        <!-- Team Management -->
        <div class="space-y-1">
            <button @click="toggleMenu('team')" class="w-full flex items-center justify-between rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
                <div class="flex items-center" :class="sidebarCollapsed ? '' : 'space-x-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Team Management</span>
                </div>
                <svg x-show="!sidebarCollapsed && openMenus.includes('team')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                <svg x-show="!sidebarCollapsed && !openMenus.includes('team')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="!sidebarCollapsed && openMenus.includes('team')" x-collapse class="ml-8 space-y-1">
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Realtors / Agents</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Team Performance</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Roles & Permissions</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Activity Logs</a>
            </div>
        </div>

        <!-- CRM & Engagement -->
        <div class="space-y-1">
            <button @click="toggleMenu('crm')" class="w-full flex items-center justify-between rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
                <div class="flex items-center" :class="sidebarCollapsed ? '' : 'space-x-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium">CRM & Engagement</span>
                </div>
                <svg x-show="!sidebarCollapsed && openMenus.includes('crm')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                <svg x-show="!sidebarCollapsed && !openMenus.includes('crm')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="!sidebarCollapsed && openMenus.includes('crm')" x-collapse class="ml-8 space-y-1">
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Leads</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Clients</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Follow-ups</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Tasks</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Appointments</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Communication Logs</a>
            </div>
        </div>

        <!-- Properties & Estates -->
        <div class="space-y-1">
            <button @click="toggleMenu('properties')" class="w-full flex items-center justify-between rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
                <div class="flex items-center" :class="sidebarCollapsed ? '' : 'space-x-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Properties & Estates</span>
                </div>
                <svg x-show="!sidebarCollapsed && openMenus.includes('properties')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                <svg x-show="!sidebarCollapsed && !openMenus.includes('properties')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="!sidebarCollapsed && openMenus.includes('properties')" x-collapse class="ml-8 space-y-1">
                <a href="{{ route('agency.properties.index') }}" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">All Properties</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Add New Property</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Categories</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">All Estates</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Add New Estate</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Plot Allocation</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">All Units/Plots</a>
            </div>
        </div>

        <!-- Sales & Deals -->
        <div class="space-y-1">
            <button @click="toggleMenu('sales')" class="w-full flex items-center justify-between rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
                <div class="flex items-center" :class="sidebarCollapsed ? '' : 'space-x-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Sales & Deals</span>
                </div>
                <svg x-show="!sidebarCollapsed && openMenus.includes('sales')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                <svg x-show="!sidebarCollapsed && !openMenus.includes('sales')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="!sidebarCollapsed && openMenus.includes('sales')" x-collapse class="ml-8 space-y-1">
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Transactions</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Offers & Negotiations</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Allocations</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Reservations</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Installment Plans</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Commission Breakdown</a>
            </div>
        </div>

        <!-- Documents & Files -->
        <div class="space-y-1">
            <button @click="toggleMenu('documents')" class="w-full flex items-center justify-between rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
                <div class="flex items-center" :class="sidebarCollapsed ? '' : 'space-x-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Documents & Files</span>
                </div>
                <svg x-show="!sidebarCollapsed && openMenus.includes('documents')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                <svg x-show="!sidebarCollapsed && !openMenus.includes('documents')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="!sidebarCollapsed && openMenus.includes('documents')" x-collapse class="ml-8 space-y-1">
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Document Manager</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Contracts & Agreements</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Title Documents</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Client Files</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">E-signature Workflows</a>
            </div>
        </div>

        <!-- Billing & Finance -->
        <div class="space-y-1">
            <button @click="toggleMenu('billing')" class="w-full flex items-center justify-between rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
                <div class="flex items-center" :class="sidebarCollapsed ? '' : 'space-x-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Billing & Finance</span>
                </div>
                <svg x-show="!sidebarCollapsed && openMenus.includes('billing')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                <svg x-show="!sidebarCollapsed && !openMenus.includes('billing')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="!sidebarCollapsed && openMenus.includes('billing')" x-collapse class="ml-8 space-y-1">
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Invoices</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Receipts</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Payment Schedules</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Payment Tracking</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Realtor Payouts</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Financial Reports</a>
            </div>
        </div>

        <!-- Marketing -->
        <div class="space-y-1">
            <button @click="toggleMenu('marketing')" class="w-full flex items-center justify-between rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
                <div class="flex items-center" :class="sidebarCollapsed ? '' : 'space-x-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Marketing</span>
                </div>
                <svg x-show="!sidebarCollapsed && openMenus.includes('marketing')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                <svg x-show="!sidebarCollapsed && !openMenus.includes('marketing')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="!sidebarCollapsed && openMenus.includes('marketing')" x-collapse class="ml-8 space-y-1">
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Website Builder</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Listings Manager</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Flyer Generator</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Media Storage</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Lead Capture Forms</a>
            </div>
        </div>

        <!-- Automation & Integrations -->
        <div class="space-y-1">
            <button @click="toggleMenu('automation')" class="w-full flex items-center justify-between rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
                <div class="flex items-center" :class="sidebarCollapsed ? '' : 'space-x-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Automation</span>
                </div>
                <svg x-show="!sidebarCollapsed && openMenus.includes('automation')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                <svg x-show="!sidebarCollapsed && !openMenus.includes('automation')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="!sidebarCollapsed && openMenus.includes('automation')" x-collapse class="ml-8 space-y-1">
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">WhatsApp Automation</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Email & SMS Templates</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Webhooks</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">API Keys</a>
            </div>
        </div>

        <!-- Reports & Analytics -->
        <div class="space-y-1">
            <button @click="toggleMenu('reports')" class="w-full flex items-center justify-between rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
                <div class="flex items-center" :class="sidebarCollapsed ? '' : 'space-x-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Reports & Analytics</span>
                </div>
                <svg x-show="!sidebarCollapsed && openMenus.includes('reports')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                <svg x-show="!sidebarCollapsed && !openMenus.includes('reports')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="!sidebarCollapsed && openMenus.includes('reports')" x-collapse class="ml-8 space-y-1">
                <a href="{{ route('agency.reports.index') }}" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Agent Performance</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Sales Reports</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Revenue Analytics</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Estate/Plot Analytics</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Marketing Analytics</a>
            </div>
        </div>

        <!-- Settings -->
        <div class="space-y-1">
            <button @click="toggleMenu('settings')" class="w-full flex items-center justify-between rounded-lg transition-colors text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
                <div class="flex items-center" :class="sidebarCollapsed ? '' : 'space-x-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium">Settings</span>
                </div>
                <svg x-show="!sidebarCollapsed && openMenus.includes('settings')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                <svg x-show="!sidebarCollapsed && !openMenus.includes('settings')" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <div x-show="!sidebarCollapsed && openMenus.includes('settings')" x-collapse class="ml-8 space-y-1">
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Agency Profile</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Branding & Theme</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Subscription Plan</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">User Management</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Payment Settings</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Security</a>
                <a href="#" class="block px-3 py-2 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Audit Logs</a>
            </div>
        </div>
    </div>
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
            <button @click="$dispatch('open-slideout', { title: 'Add New Property', description: 'Create a new property listing' }); currentSlideout = 'add-property'"
                    class="flex items-center justify-center space-x-2 bg-primary-600 hover:bg-primary-700 text-white px-6 py-4 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                <span>Add Property</span>
            </button>
            <button @click="$dispatch('open-slideout', { title: 'Add New Agent', description: 'Invite a new agent to your agency' }); currentSlideout = 'add-agent'"
                    class="flex items-center justify-center space-x-2 bg-secondary-100 dark:bg-secondary-700 text-secondary-900 dark:text-white hover:bg-secondary-200 dark:hover:bg-secondary-600 px-6 py-4 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                <span>Add Agent</span>
            </button>
            <button class="flex items-center justify-center space-x-2 bg-secondary-100 dark:bg-secondary-700 text-secondary-900 dark:text-white hover:bg-secondary-200 dark:hover:bg-secondary-600 px-6 py-4 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                <span>View Reports</span>
            </button>
            <button class="flex items-center justify-center space-x-2 bg-secondary-100 dark:bg-secondary-700 text-secondary-900 dark:text-white hover:bg-secondary-200 dark:hover:bg-secondary-600 px-6 py-4 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                <span>Settings</span>
            </button>
        </div>
    </div>
@endsection

@section('slideouts')
    <!-- Add Property Form -->
    <div x-show="currentSlideout === 'add-property'" x-cloak x-data="{ type: 'sale' }">
        <form action="{{ route('agency.properties.store') }}" method="POST" enctype="multipart/form-data" class="h-full flex flex-col">
            @csrf

            <!-- Form Content (Scrollable) -->
            <div class="flex-1 overflow-y-auto px-6 py-6 space-y-6">
                <!-- Basic Information -->
                <div>
                    <h3 class="text-sm font-semibold text-secondary-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Basic Information
                    </h3>
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Property Title <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" name="title" id="title" required
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="e.g., Luxury 4 Bedroom Villa with Pool">
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Category <span class="text-danger-600">*</span>
                            </label>
                            <select name="category_id" id="category_id" required
                                    class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors">
                                <option value="">Select Category</option>
                                <option value="1">Land</option>
                                <option value="2">Houses</option>
                                <option value="3">Apartments</option>
                                <option value="4">Commercial</option>
                                <option value="5">Shortlet</option>
                                <option value="6">Estates</option>
                            </select>
                        </div>

                        <!-- Listing Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Listing Type <span class="text-danger-600">*</span>
                            </label>
                            <select name="type" id="type" x-model="type" required
                                    class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors">
                                <option value="sale">For Sale</option>
                                <option value="rent">For Rent</option>
                                <option value="lease">For Lease</option>
                                <option value="shortlet">Shortlet</option>
                            </select>
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Price (USD) <span class="text-danger-600">*</span>
                            </label>
                            <input type="number" name="price" id="price" required
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="450000">
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Description <span class="text-danger-600">*</span>
                            </label>
                            <textarea name="description" id="description" rows="3" required
                                      class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                      placeholder="Describe the property..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Location -->
                <div>
                    <h3 class="text-sm font-semibold text-secondary-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Location
                    </h3>
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Street Address <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" name="address" id="address" required
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="123 Main Street">
                        </div>

                        <!-- City & State -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="city" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                    City <span class="text-danger-600">*</span>
                                </label>
                                <input type="text" name="city" id="city" required
                                       class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                       placeholder="Los Angeles">
                            </div>
                            <div>
                                <label for="state" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                    State <span class="text-danger-600">*</span>
                                </label>
                                <input type="text" name="state" id="state" required
                                       class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                       placeholder="California">
                            </div>
                        </div>

                        <!-- Country -->
                        <div>
                            <label for="country" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Country <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" name="country" id="country" required value="United States"
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors">
                        </div>
                    </div>
                </div>

                <!-- Property Details -->
                <div>
                    <h3 class="text-sm font-semibold text-secondary-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                        </svg>
                        Property Details
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Bedrooms -->
                        <div>
                            <label for="bedrooms" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Bedrooms
                            </label>
                            <input type="number" name="bedrooms" id="bedrooms"
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="4">
                        </div>

                        <!-- Bathrooms -->
                        <div>
                            <label for="bathrooms" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Bathrooms
                            </label>
                            <input type="number" name="bathrooms" id="bathrooms"
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="3">
                        </div>

                        <!-- Area -->
                        <div>
                            <label for="area" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Area (sqft)
                            </label>
                            <input type="number" name="area" id="area"
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="2500">
                        </div>

                        <!-- Year Built -->
                        <div>
                            <label for="year_built" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                                Year Built
                            </label>
                            <input type="number" name="year_built" id="year_built"
                                   class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white placeholder-secondary-400 focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                                   placeholder="2020">
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5">
                        Status
                    </label>
                    <select name="status" id="status"
                            class="w-full px-3 py-2.5 bg-white dark:bg-secondary-900 border border-secondary-300 dark:border-secondary-600 rounded-lg text-secondary-900 dark:text-white focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors">
                        <option value="draft">Draft</option>
                        <option value="available" selected>Available</option>
                        <option value="pending">Pending</option>
                    </select>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Save Property</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Add Agent Form -->
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
