<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtor Dashboard - RealEstate Pro</title>
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
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg shadow-lg p-8 text-white mb-8">
                <h2 class="text-3xl font-bold mb-2">
                    <i class="fas fa-user-tie mr-2"></i> Welcome, {{ auth()->user()->name }}!
                </h2>
                <p class="text-blue-100">Realtor Dashboard</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- My Leads -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">My Leads</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">42</p>
                            <p class="text-sm text-blue-600 mt-1">
                                <i class="fas fa-arrow-up"></i> 8 new this week
                            </p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-4">
                            <i class="fas fa-user-plus text-blue-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- My Clients -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Active Clients</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">28</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-check-circle"></i> 5 active deals
                            </p>
                        </div>
                        <div class="bg-green-100 rounded-full p-4">
                            <i class="fas fa-users text-green-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Commissions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">This Month</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">$8,500</p>
                            <p class="text-sm text-purple-600 mt-1">
                                <i class="fas fa-wallet"></i> Commissions
                            </p>
                        </div>
                        <div class="bg-purple-100 rounded-full p-4">
                            <i class="fas fa-dollar-sign text-purple-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Appointments -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Upcoming</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">7</p>
                            <p class="text-sm text-orange-600 mt-1">
                                <i class="fas fa-calendar"></i> Appointments
                            </p>
                        </div>
                        <div class="bg-orange-100 rounded-full p-4">
                            <i class="fas fa-calendar-check text-orange-600 text-2xl"></i>
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
                        <i class="fas fa-user-plus"></i>
                        <span>Add Lead</span>
                    </button>
                    <button class="flex items-center justify-center space-x-2 bg-green-50 hover:bg-green-100 text-green-700 px-6 py-4 rounded-lg transition-colors">
                        <i class="fas fa-calendar-plus"></i>
                        <span>Schedule Appointment</span>
                    </button>
                    <button class="flex items-center justify-center space-x-2 bg-purple-50 hover:bg-purple-100 text-purple-700 px-6 py-4 rounded-lg transition-colors">
                        <i class="fas fa-home"></i>
                        <span>View Properties</span>
                    </button>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
