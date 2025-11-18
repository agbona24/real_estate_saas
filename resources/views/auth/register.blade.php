<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Account - RealEstate Pro</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900|poppins:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-600 via-purple-600 to-purple-700 min-h-screen font-sans">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center space-x-3 mb-6">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center shadow-lg">
                        <i class="fas fa-building text-white text-2xl"></i>
                    </div>
                    <span class="text-3xl font-display font-bold text-white">
                        RealEstate<span class="gradient-text">Pro</span>
                    </span>
                </a>
                <h2 class="text-3xl font-bold text-white mb-2">
                    Create Your Account
                </h2>
                <p class="text-blue-100">
                    Start your 14-day free trial • No credit card required
                </p>
            </div>

            <!-- Registration Card -->
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle text-red-500 mt-0.5 mr-3"></i>
                            <div>
                                <h3 class="text-sm font-medium text-red-800 mb-1">Please fix the following errors:</h3>
                                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Full Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-gray-400"></i>Full Name
                        </label>
                        <input id="name"
                               type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               autofocus
                               class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="John Smith">
                    </div>

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-gray-400"></i>Email Address
                        </label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="john@company.com">
                    </div>

                    <!-- Account Type -->
                    <div class="mb-4">
                        <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user-tag mr-2 text-gray-400"></i>Account Type
                        </label>
                        <select id="role"
                                name="role"
                                required
                                class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select your role...</option>
                            <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="agency_admin" {{ old('role') == 'agency_admin' ? 'selected' : '' }}>Agency Admin</option>
                            <option value="realtor" {{ old('role') == 'realtor' ? 'selected' : '' }}>Realtor/Agent</option>
                            <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Choose the role that best describes you</p>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-gray-400"></i>Password
                        </label>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="••••••••">
                        <p class="mt-1 text-xs text-gray-500">Minimum 8 characters</p>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-gray-400"></i>Confirm Password
                        </label>
                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               required
                               class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="••••••••">
                    </div>

                    <!-- Terms Agreement -->
                    <div class="mb-6">
                        <label class="flex items-start">
                            <input type="checkbox" required class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <span class="ml-2 text-sm text-gray-600">
                                I agree to the <a href="#" class="text-blue-600 hover:text-purple-600 font-medium">Terms of Service</a> and <a href="#" class="text-blue-600 hover:text-purple-600 font-medium">Privacy Policy</a>
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                                class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-base font-bold text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-150 transform hover:scale-105">
                            <i class="fas fa-rocket mr-2"></i>
                            Create Account & Start Free Trial
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account?
                            <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-purple-600 transition-colors">
                                Sign In →
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Features -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide text-center mb-4">What's Included</p>
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-500"></i>
                            <span class="text-gray-700">14-day free trial</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-500"></i>
                            <span class="text-gray-700">No credit card required</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-500"></i>
                            <span class="text-gray-700">Unlimited properties</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-500"></i>
                            <span class="text-gray-700">24/7 support</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <p class="mt-8 text-center text-sm text-white/80">
                &copy; {{ date('Y') }} RealEstatePro. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
