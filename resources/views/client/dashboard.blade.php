<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard - RealEstate Pro</title>
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
            <div class="bg-gradient-to-r from-green-600 to-teal-600 rounded-lg shadow-lg p-8 text-white mb-8">
                <h2 class="text-3xl font-bold mb-2">
                    <i class="fas fa-user mr-2"></i> Welcome, {{ auth()->user()->name }}!
                </h2>
                <p class="text-green-100">Client Portal</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- My Properties -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">My Properties</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['my_properties'] }}</p>
                            <p class="text-sm text-blue-600 mt-1">
                                <i class="fas fa-home"></i> Owned properties
                            </p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-4">
                            <i class="fas fa-home text-blue-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Pending Payments -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Pending Payments</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">${{ number_format($stats['pending_payments'], 0) }}</p>
                            <p class="text-sm text-orange-600 mt-1">
                                <i class="fas fa-clock"></i> Due soon
                            </p>
                        </div>
                        <div class="bg-orange-100 rounded-full p-4">
                            <i class="fas fa-dollar-sign text-orange-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">My Documents</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['my_documents'] }}</p>
                            <p class="text-sm text-purple-600 mt-1">
                                <i class="fas fa-file-alt"></i> Available
                            </p>
                        </div>
                        <div class="bg-purple-100 rounded-full p-4">
                            <i class="fas fa-file-alt text-purple-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    <i class="fas fa-bolt text-yellow-500 mr-2"></i> Quick Actions
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <button class="flex items-center justify-center space-x-2 bg-blue-50 hover:bg-blue-100 text-blue-700 px-6 py-4 rounded-lg transition-colors">
                        <i class="fas fa-search"></i>
                        <span>Browse Properties</span>
                    </button>
                    <button class="flex items-center justify-center space-x-2 bg-green-50 hover:bg-green-100 text-green-700 px-6 py-4 rounded-lg transition-colors">
                        <i class="fas fa-credit-card"></i>
                        <span>Make Payment</span>
                    </button>
                    <button class="flex items-center justify-center space-x-2 bg-purple-50 hover:bg-purple-100 text-purple-700 px-6 py-4 rounded-lg transition-colors">
                        <i class="fas fa-file-download"></i>
                        <span>Download Documents</span>
                    </button>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
