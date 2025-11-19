<!-- Sidebar -->
<aside
    x-data="{ activeSubmenu: null }"
    class="fixed left-0 top-0 z-40 h-screen transition-all duration-300 ease-in-out bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 shadow-lg"
    :class="sidebarOpen ? 'w-64' : 'w-20'"
>
    <!-- Logo & Brand -->
    <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center space-x-3">
            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-primary-500">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </div>
            <div x-show="sidebarOpen" x-transition class="flex flex-col">
                <span class="text-sm font-bold text-gray-900 dark:text-white">RealEstate</span>
                <span class="text-xs text-gray-500 dark:text-gray-400">Agency Portal</span>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-3 py-4 overflow-y-auto h-[calc(100vh-4rem)]">
        <ul class="space-y-1">
            <!-- Dashboard -->
            <li>
                <div x-data="{ open: activeSubmenu === 'dashboard' }">
                    <button
                        @click="activeSubmenu = activeSubmenu === 'dashboard' ? null : 'dashboard'"
                        class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group"
                        :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900 dark:text-primary-400': {{ request()->is('agency/dashboard*') ? 'true' : 'false' }} }"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span x-show="sidebarOpen" x-transition>Dashboard</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="{ 'rotate-90': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <ul x-show="open && sidebarOpen" x-collapse class="mt-1 ml-8 space-y-1">
                        <li><a href="{{ route('agency.dashboard') }}" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Overview</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Sales Pipeline</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Quick Stats</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Recent Activities</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Notifications</a></li>
                    </ul>
                </div>
            </li>

            <!-- Team Management -->
            <li>
                <div x-data="{ open: activeSubmenu === 'team' }">
                    <button
                        @click="activeSubmenu = activeSubmenu === 'team' ? null : 'team'"
                        class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900 dark:text-primary-400': {{ request()->is('agency/team*') ? 'true' : 'false' }} }"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span x-show="sidebarOpen" x-transition>Team Management</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="{ 'rotate-90': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <ul x-show="open && sidebarOpen" x-collapse class="mt-1 ml-8 space-y-1">
                        <li><a href="{{ route('agency.team.index') }}" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Realtors / Agents</a></li>
                        <li><a href="{{ route('agency.team.performance') }}" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Team Performance</a></li>
                        <li><a href="{{ route('agency.team.roles') }}" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Roles & Permissions</a></li>
                        <li><a href="{{ route('agency.team.activity-logs') }}" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Activity Logs</a></li>
                    </ul>
                </div>
            </li>

            <!-- CRM & Engagement -->
            <li>
                <div x-data="{ open: activeSubmenu === 'crm' }">
                    <button
                        @click="activeSubmenu = activeSubmenu === 'crm' ? null : 'crm'"
                        class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900 dark:text-primary-400': {{ request()->is('agency/crm*') ? 'true' : 'false' }} }"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            <span x-show="sidebarOpen" x-transition>CRM & Engagement</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="{ 'rotate-90': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <ul x-show="open && sidebarOpen" x-collapse class="mt-1 ml-8 space-y-1">
                        <li><a href="{{ route('agency.crm.leads') }}" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Leads</a></li>
                        <li><a href="{{ route('agency.crm.clients') }}" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Clients</a></li>
                        <li><a href="{{ route('agency.crm.follow-ups') }}" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Follow-ups</a></li>
                        <li><a href="{{ route('agency.crm.tasks') }}" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Tasks</a></li>
                        <li><a href="{{ route('agency.crm.appointments') }}" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Appointments</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Communication Logs</a></li>
                    </ul>
                </div>
            </li>

            <!-- Properties & Estates -->
            <li>
                <div x-data="{ open: activeSubmenu === 'properties' }">
                    <button
                        @click="activeSubmenu = activeSubmenu === 'properties' ? null : 'properties'"
                        class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900 dark:text-primary-400': {{ request()->is('agency/properties*') || request()->is('agency/estates*') || request()->is('agency/units*') ? 'true' : 'false' }} }"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span x-show="sidebarOpen" x-transition>Properties & Estates</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="{ 'rotate-90': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <ul x-show="open && sidebarOpen" x-collapse class="mt-1 ml-8 space-y-1">
                        <li><a href="{{ route('agency.properties.index') }}" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">All Properties</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">All Estates</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Units/Plots</a></li>
                        <li><a href="{{ route('agency.properties.categories') }}" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Categories</a></li>
                    </ul>
                </div>
            </li>

            <!-- Sales & Deals -->
            <li>
                <div x-data="{ open: activeSubmenu === 'sales' }">
                    <button
                        @click="activeSubmenu = activeSubmenu === 'sales' ? null : 'sales'"
                        class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900 dark:text-primary-400': {{ request()->is('agency/sales*') ? 'true' : 'false' }} }"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span x-show="sidebarOpen" x-transition>Sales & Deals</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="{ 'rotate-90': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <ul x-show="open && sidebarOpen" x-collapse class="mt-1 ml-8 space-y-1">
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Transactions</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Offers & Negotiations</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Allocations</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Reservations</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Installment Plans</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Commission Breakdown</a></li>
                    </ul>
                </div>
            </li>

            <!-- Documents & Files -->
            <li>
                <div x-data="{ open: activeSubmenu === 'documents' }">
                    <button
                        @click="activeSubmenu = activeSubmenu === 'documents' ? null : 'documents'"
                        class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900 dark:text-primary-400': {{ request()->is('agency/documents*') ? 'true' : 'false' }} }"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span x-show="sidebarOpen" x-transition>Documents & Files</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="{ 'rotate-90': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <ul x-show="open && sidebarOpen" x-collapse class="mt-1 ml-8 space-y-1">
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Document Manager</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Contracts</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Title Documents</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">E-signature</a></li>
                    </ul>
                </div>
            </li>

            <!-- Billing & Finance -->
            <li>
                <div x-data="{ open: activeSubmenu === 'finance' }">
                    <button
                        @click="activeSubmenu = activeSubmenu === 'finance' ? null : 'finance'"
                        class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900 dark:text-primary-400': {{ request()->is('agency/finance*') ? 'true' : 'false' }} }"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            <span x-show="sidebarOpen" x-transition>Billing & Finance</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="{ 'rotate-90': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <ul x-show="open && sidebarOpen" x-collapse class="mt-1 ml-8 space-y-1">
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Invoices</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Receipts</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Payment Tracking</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Payouts</a></li>
                    </ul>
                </div>
            </li>

            <!-- Marketing -->
            <li>
                <div x-data="{ open: activeSubmenu === 'marketing' }">
                    <button
                        @click="activeSubmenu = activeSubmenu === 'marketing' ? null : 'marketing'"
                        class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900 dark:text-primary-400': {{ request()->is('agency/marketing*') ? 'true' : 'false' }} }"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                            </svg>
                            <span x-show="sidebarOpen" x-transition>Marketing</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="{ 'rotate-90': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <ul x-show="open && sidebarOpen" x-collapse class="mt-1 ml-8 space-y-1">
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Website Builder</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Listings Manager</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Flyer Generator</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Media Storage</a></li>
                    </ul>
                </div>
            </li>

            <!-- Automation -->
            <li>
                <div x-data="{ open: activeSubmenu === 'automation' }">
                    <button
                        @click="activeSubmenu = activeSubmenu === 'automation' ? null : 'automation'"
                        class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900 dark:text-primary-400': {{ request()->is('agency/automation*') ? 'true' : 'false' }} }"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <span x-show="sidebarOpen" x-transition>Automation</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="{ 'rotate-90': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <ul x-show="open && sidebarOpen" x-collapse class="mt-1 ml-8 space-y-1">
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">WhatsApp</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Email & SMS Templates</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Webhooks</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">API Keys</a></li>
                    </ul>
                </div>
            </li>

            <!-- Reports & Analytics -->
            <li>
                <div x-data="{ open: activeSubmenu === 'reports' }">
                    <button
                        @click="activeSubmenu = activeSubmenu === 'reports' ? null : 'reports'"
                        class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900 dark:text-primary-400': {{ request()->is('agency/reports*') ? 'true' : 'false' }} }"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span x-show="sidebarOpen" x-transition>Reports & Analytics</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="{ 'rotate-90': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <ul x-show="open && sidebarOpen" x-collapse class="mt-1 ml-8 space-y-1">
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Agent Performance</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Sales Reports</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Revenue Analytics</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Marketing Analytics</a></li>
                    </ul>
                </div>
            </li>

            <!-- Settings -->
            <li>
                <div x-data="{ open: activeSubmenu === 'settings' }">
                    <button
                        @click="activeSubmenu = activeSubmenu === 'settings' ? null : 'settings'"
                        class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        :class="{ 'bg-primary-50 text-primary-600 dark:bg-primary-900 dark:text-primary-400': {{ request()->is('agency/settings*') ? 'true' : 'false' }} }"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span x-show="sidebarOpen" x-transition>Settings</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="{ 'rotate-90': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <ul x-show="open && sidebarOpen" x-collapse class="mt-1 ml-8 space-y-1">
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Agency Profile</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Branding & Theme</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Subscription</a></li>
                        <li><a href="#" class="block px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Security</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidebar Toggle Button -->
    <button
        @click="sidebarOpen = !sidebarOpen"
        class="absolute top-1/2 -right-3 flex items-center justify-center w-6 h-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full shadow-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
    >
        <svg x-show="sidebarOpen" class="w-3 h-3 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        <svg x-show="!sidebarOpen" class="w-3 h-3 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
</aside>
