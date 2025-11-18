<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - RealEstate Pro</title>

    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fef3f2',
                            600: '#de3b27',
                            700: '#bc2f1d',
                        },
                        secondary: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        },
                        success: {
                            100: '#dcfce7',
                            600: '#16a34a',
                            800: '#166534',
                        },
                        warning: {
                            100: '#fef3c7',
                            500: '#eab308',
                            800: '#854d0e',
                        },
                        danger: {
                            100: '#fee2e2',
                            600: '#dc2626',
                            800: '#991b1b',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
                        'hard': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                    },
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
</head>
<body class="bg-secondary-50 dark:bg-secondary-900 font-sans antialiased"
      x-data="{
          sidebarOpen: false,
          sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
          userMenuOpen: false,
          notificationsOpen: false
      }"
      x-init="
          $watch('darkMode', v => localStorage.setItem('darkMode', v));
          $watch('sidebarCollapsed', v => localStorage.setItem('sidebarCollapsed', v));
      ">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="bg-white dark:bg-secondary-800 border-r border-secondary-200 dark:border-secondary-700 transition-all duration-300"
               :class="sidebarCollapsed ? 'w-20' : 'w-64'">
            <div class="flex flex-col h-full">
                <!-- Logo Section -->
                <div class="h-16 flex items-center border-b border-secondary-200 dark:border-secondary-700"
                     :class="sidebarCollapsed ? 'justify-center px-4' : 'justify-between px-6'">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary-600 to-primary-700 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div x-show="!sidebarCollapsed" x-cloak>
                            <h1 class="text-xl font-bold text-secondary-900 dark:text-white">RealEstate<span class="text-primary-600">Pro</span></h1>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                    @yield('navigation')
                </nav>

                <!-- Collapse Toggle -->
                <div class="p-3 border-t border-secondary-200 dark:border-secondary-700">
                    <button @click="sidebarCollapsed = !sidebarCollapsed"
                            class="w-full flex items-center justify-center p-3 rounded-lg text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700 transition-colors">
                        <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': sidebarCollapsed }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                        </svg>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="h-16 bg-white dark:bg-secondary-800 border-b border-secondary-200 dark:border-secondary-700">
                <div class="h-full px-6 flex items-center justify-between">
                    <!-- Left Side - Page Title -->
                    <div class="flex items-center space-x-4">
                        <h2 class="text-lg font-semibold text-secondary-900 dark:text-white">@yield('page-title', 'Dashboard')</h2>
                    </div>

                    <!-- Right Side - Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Dark Mode Toggle -->
                        <button @click="darkMode = !darkMode"
                                class="p-2 rounded-lg text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700 transition-colors">
                            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <svg x-show="darkMode" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </button>

                        <!-- Notifications -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                    class="p-2 rounded-lg text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700 transition-colors relative">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span class="absolute top-1 right-1 w-2 h-2 bg-primary-600 rounded-full"></span>
                            </button>

                            <!-- Notifications Dropdown -->
                            <div x-show="open"
                                 @click.away="open = false"
                                 x-transition
                                 x-cloak
                                 class="absolute right-0 mt-2 w-80 bg-white dark:bg-secondary-800 rounded-xl shadow-hard border border-secondary-200 dark:border-secondary-700 z-50">
                                <div class="p-4 border-b border-secondary-200 dark:border-secondary-700">
                                    <h3 class="font-semibold text-secondary-900 dark:text-white">Notifications</h3>
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    <div class="p-4 text-sm text-secondary-600 dark:text-secondary-400 text-center">
                                        No new notifications
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                    class="flex items-center space-x-3 p-2 rounded-lg hover:bg-secondary-50 dark:hover:bg-secondary-700 transition-colors">
                                <div class="text-right">
                                    <p class="text-sm font-medium text-secondary-900 dark:text-white">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-secondary-600 dark:text-secondary-400">{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</p>
                                </div>
                                <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center">
                                    <span class="text-primary-700 dark:text-primary-300 font-semibold text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                                </div>
                            </button>

                            <!-- User Dropdown -->
                            <div x-show="open"
                                 @click.away="open = false"
                                 x-transition
                                 x-cloak
                                 class="absolute right-0 mt-2 w-56 bg-white dark:bg-secondary-800 rounded-xl shadow-hard border border-secondary-200 dark:border-secondary-700 z-50">
                                <div class="p-2">
                                    <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded-lg text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span class="text-sm font-medium">Profile</span>
                                    </a>
                                    <a href="#" class="flex items-center space-x-2 px-3 py-2 rounded-lg text-secondary-700 dark:text-secondary-200 hover:bg-secondary-50 dark:hover:bg-secondary-700 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="text-sm font-medium">Settings</span>
                                    </a>
                                    <div class="border-t border-secondary-200 dark:border-secondary-700 my-2"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center space-x-2 px-3 py-2 rounded-lg text-danger-600 dark:text-danger-400 hover:bg-danger-50 dark:hover:bg-danger-900/20 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span class="text-sm font-medium">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <!-- Flash Messages -->
                    @if (session('success'))
                        <div class="mb-6 bg-success-100 border border-success-600 text-success-800 px-4 py-3 rounded-lg" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 bg-danger-100 border border-danger-600 text-danger-800 px-4 py-3 rounded-lg" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
