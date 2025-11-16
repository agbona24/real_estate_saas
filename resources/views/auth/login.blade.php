<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body class="bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <div class="bg-indigo-600 rounded-full p-4">
                        <i class="fas fa-building text-white text-4xl"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900">
                    Real Estate SaaS
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Sign in to your account
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

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input id="remember_me"
                                   type="checkbox"
                                   name="remember"
                                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                Remember me
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Forgot password?
                            </a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Sign In
                        </button>
                    </div>

                    <!-- Register Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Create Agency Account
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
            <p class="mt-8 text-center text-xs text-gray-500">
                &copy; {{ date('Y') }} Real Estate SaaS. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
