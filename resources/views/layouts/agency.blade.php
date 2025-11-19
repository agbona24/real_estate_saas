<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: true, darkMode: false }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Real Estate SaaS') }} - Agency Portal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">

    <!-- Toast Notifications Container -->
    <x-agency.toast-container />

    <!-- Sidebar -->
    <x-agency.sidebar />

    <!-- Main Content Area -->
    <div
        class="transition-all duration-300 ease-in-out"
        :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'"
    >
        <!-- Top Navigation Bar -->
        <x-agency.topbar />

        <!-- Page Content -->
        <main class="p-6">
            <!-- Page Header -->
            @if(isset($header))
                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $header }}
                            </h1>
                            @if(isset($description))
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $description }}
                                </p>
                            @endif
                        </div>
                        @if(isset($headerActions))
                            <div class="flex items-center space-x-3">
                                {{ $headerActions }}
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Main Content -->
            {{ $slot }}
        </main>
    </div>

    <!-- Slide-out Panel -->
    <x-agency.slide-panel />

    @stack('scripts')
</body>
</html>
