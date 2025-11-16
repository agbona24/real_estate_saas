<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard - RealEstate Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <i class="fas fa-building text-white"></i>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900">RealEstate<span class="text-purple-600">Pro</span></h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-red-600 to-pink-600 rounded-lg shadow-lg p-8 text-white mb-8">
                <h2 class="text-3xl font-bold mb-2">
                    <i class="fas fa-crown mr-2"></i> Welcome, {{ auth()->user()->name }}!
                </h2>
                <p class="text-red-100">Super Admin Control Panel</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Agencies -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Agencies</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_agencies'] }}</p>
                            <p class="text-sm text-blue-600 mt-1">
                                <i class="fas fa-arrow-up"></i> {{ $stats['new_agencies_this_month'] }} new this month
                            </p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-4">
                            <i class="fas fa-building text-blue-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Users</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_users'] }}</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-users"></i> Across all agencies
                            </p>
                        </div>
                        <div class="bg-green-100 rounded-full p-4">
                            <i class="fas fa-users text-green-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Properties -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Properties</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_properties'] }}</p>
                            <p class="text-sm text-purple-600 mt-1">
                                <i class="fas fa-home"></i> Platform-wide
                            </p>
                        </div>
                        <div class="bg-purple-100 rounded-full p-4">
                            <i class="fas fa-home text-purple-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- System Health -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">System Health</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">100%</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-check-circle"></i> All systems operational
                            </p>
                        </div>
                        <div class="bg-green-100 rounded-full p-4">
                            <i class="fas fa-server text-green-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    <i class="fas fa-bolt text-yellow-500 mr-2"></i> Admin Actions
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <button class="flex items-center justify-center space-x-2 bg-blue-50 hover:bg-blue-100 text-blue-700 px-6 py-4 rounded-lg transition-colors">
                        <i class="fas fa-plus"></i>
                        <span>Add Agency</span>
                    </button>
                    <button class="flex items-center justify-center space-x-2 bg-green-50 hover:bg-green-100 text-green-700 px-6 py-4 rounded-lg transition-colors">
                        <i class="fas fa-users-cog"></i>
                        <span>Manage Users</span>
                    </button>
                    <button class="flex items-center justify-center space-x-2 bg-purple-50 hover:bg-purple-100 text-purple-700 px-6 py-4 rounded-lg transition-colors">
                        <i class="fas fa-chart-bar"></i>
                        <span>Analytics</span>
                    </button>
                    <button class="flex items-center justify-center space-x-2 bg-red-50 hover:bg-red-100 text-red-700 px-6 py-4 rounded-lg transition-colors">
                        <i class="fas fa-cogs"></i>
                        <span>System Settings</span>
                    </button>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
