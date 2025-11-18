<div x-data="{
    openMenus: [],
    toggleMenu(menu) {
        if (this.openMenus.includes(menu)) {
            this.openMenus = this.openMenus.filter(m => m !== menu);
        } else {
            this.openMenus.push(menu);
        }
    }
}">
    <!-- Dashboard (Single Link) -->
    <a href="{{ route('dashboard') }}" class="flex items-center rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-700' : 'text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700' }}" :class="sidebarCollapsed ? 'justify-center p-3' : 'space-x-3 px-3 py-2.5'">
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
            <a href="{{ route('agency.agents.index') }}" class="block px-3 py-2 text-sm {{ request()->routeIs('agency.agents.*') ? 'text-primary-600 dark:text-primary-400 font-medium' : 'text-secondary-600 dark:text-secondary-400' }} hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Realtors / Agents</a>
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
            <a href="{{ route('agency.properties.index') }}" class="block px-3 py-2 text-sm {{ request()->routeIs('agency.properties.*') ? 'text-primary-600 dark:text-primary-400 font-medium' : 'text-secondary-600 dark:text-secondary-400' }} hover:text-primary-600 dark:hover:text-primary-400 transition-colors">All Properties</a>
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
            <a href="{{ route('agency.reports.index') }}" class="block px-3 py-2 text-sm {{ request()->routeIs('agency.reports.*') ? 'text-primary-600 dark:text-primary-400 font-medium' : 'text-secondary-600 dark:text-secondary-400' }} hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Agent Performance</a>
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
