<nav class="bg-white border-b border-gray-200" x-data="{ open: false, userMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Side -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <i class="fas fa-building text-indigo-600 text-2xl mr-2"></i>
                        <span class="font-bold text-xl text-gray-800">RealEstate SaaS</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                        @if(auth()->user()->hasRole('super_admin'))
                            <!-- Super Admin Menu -->
                            <a href="{{ route('superadmin.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('superadmin.*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </a>
                            <a href="{{ route('superadmin.agencies.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('superadmin.agencies.*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-building mr-2"></i> Agencies
                            </a>
                            <a href="{{ route('superadmin.plans.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('superadmin.plans.*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-tags mr-2"></i> Plans
                            </a>
                            <a href="{{ route('superadmin.themes.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('superadmin.themes.*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-palette mr-2"></i> Themes
                            </a>

                        @elseif(auth()->user()->hasRole('agency_admin'))
                            <!-- Agency Admin Menu -->
                            <a href="{{ route('agency.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('agency.dashboard') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </a>
                            <a href="{{ route('agency.leads.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('agency.leads.*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-user-plus mr-2"></i> Leads
                            </a>
                            <a href="{{ route('agency.clients.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('agency.clients.*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-users mr-2"></i> Clients
                            </a>
                            <a href="{{ route('agency.properties.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('agency.properties.*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-home mr-2"></i> Properties
                            </a>
                            <a href="{{ route('agency.realtors.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('agency.realtors.*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-user-tie mr-2"></i> Team
                            </a>

                        @elseif(auth()->user()->hasRole('realtor'))
                            <!-- Realtor Menu -->
                            <a href="{{ route('realtor.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('realtor.dashboard') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </a>
                            <a href="{{ route('realtor.leads.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('realtor.leads.*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-user-plus mr-2"></i> My Leads
                            </a>
                            <a href="{{ route('realtor.clients.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('realtor.clients.*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-users mr-2"></i> My Clients
                            </a>
                            <a href="{{ route('realtor.properties.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('realtor.properties.*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-home mr-2"></i> Properties
                            </a>

                        @elseif(auth()->user()->hasRole('client'))
                            <!-- Client Menu -->
                            <a href="{{ route('client.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('client.dashboard') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </a>
                            <a href="{{ route('client.properties') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('client.properties') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-home mr-2"></i> My Properties
                            </a>
                            <a href="{{ route('client.documents') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('client.documents') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-file-alt mr-2"></i> Documents
                            </a>
                            <a href="{{ route('client.payments') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('client.payments') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                <i class="fas fa-credit-card mr-2"></i> Payments
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <!-- Notifications -->
                    <button class="relative p-2 text-gray-400 hover:text-gray-600 focus:outline-none mr-4">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">3</span>
                    </button>

                    <!-- User Dropdown -->
                    <div class="relative" @click.away="userMenuOpen = false">
                        <button @click="userMenuOpen = !userMenuOpen" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out">
                            <div class="flex items-center">
                                <img class="h-8 w-8 rounded-full object-cover mr-2" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ auth()->user()->name }}">
                                <span>{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                            </div>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="userMenuOpen"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-50"
                             style="display: none;">

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> Profile
                            </a>

                            @if(auth()->user()->hasRole('agency_admin'))
                                <a href="{{ route('agency.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-cog mr-2"></i> Settings
                                </a>
                                <a href="{{ route('agency.subscription') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-credit-card mr-2"></i> Subscription
                                </a>
                            @endif

                            <hr class="my-1">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900 mr-4">Login</a>
                    <a href="{{ route('register') }}" class="text-sm text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-md">Register</a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <i class="fas fa-bars text-xl" x-show="!open"></i>
                    <i class="fas fa-times text-xl" x-show="open" style="display: none;"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" class="sm:hidden" style="display: none;">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <!-- Mobile menu items based on role -->
                <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-indigo-500 text-base font-medium text-indigo-700 bg-indigo-50">Dashboard</a>
            @endauth
        </div>
    </div>
</nav>
