<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - RealEstate Pro</title>

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
                    Welcome Back
                </h2>
                <p class="text-blue-100">
                    Sign in to access your dashboard
                </p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-lg shadow-xl p-8">
                @if (session('status'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-gray-400"></i>Email Address
                        </label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="you@example.com">
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-gray-400"></i>Password
                        </label>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="••••••••">
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center mb-6">
                        <input id="remember_me"
                               type="checkbox"
                               name="remember"
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                            Remember me for 30 days
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                                class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-base font-bold text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-150 transform hover:scale-105">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Sign In to Dashboard
                        </button>
                    </div>

                    <!-- Register Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-purple-600 transition-colors">
                                Create Free Account →
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Demo Credentials -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <p class="text-xs text-gray-500 text-center mb-3">Demo Credentials:</p>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="bg-gray-50 p-2 rounded">
                            <p class="font-semibold text-gray-700">Super Admin</p>
                            <p class="text-gray-600">admin@demo.com</p>
                        </div>
                        <div class="bg-gray-50 p-2 rounded">
                            <p class="font-semibold text-gray-700">Agency Admin</p>
                            <p class="text-gray-600">agency@demo.com</p>
                        </div>
                        <div class="bg-gray-50 p-2 rounded">
                            <p class="font-semibold text-gray-700">Realtor</p>
                            <p class="text-gray-600">realtor@demo.com</p>
                        </div>
                        <div class="bg-gray-50 p-2 rounded">
                            <p class="font-semibold text-gray-700">Client</p>
                            <p class="text-gray-600">client@demo.com</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 text-center mt-2">Password: <code class="bg-gray-200 px-1 rounded">password</code></p>
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
