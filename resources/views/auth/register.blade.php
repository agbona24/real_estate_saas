<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register Agency - {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <div class="bg-indigo-600 rounded-full p-4">
                        <i class="fas fa-building text-white text-4xl"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900">
                    Create Agency Account
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Start your 14-day free trial
                </p>
            </div>

            <!-- Registration Card -->
            <div class="bg-white rounded-lg shadow-xl p-8" x-data="{ step: 1 }">

                <!-- Progress Steps -->
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <div :class="step >= 1 ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-600'" class="rounded-full h-10 w-10 flex items-center justify-center font-bold">
                                    1
                                </div>
                                <div class="ml-3">
                                    <p :class="step >= 1 ? 'text-indigo-600' : 'text-gray-500'" class="text-sm font-medium">Agency Info</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 border-t-2" :class="step >= 2 ? 'border-indigo-600' : 'border-gray-200'"></div>
                        <div class="flex-1">
                            <div class="flex items-center">
                                <div :class="step >= 2 ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-600'" class="rounded-full h-10 w-10 flex items-center justify-center font-bold">
                                    2
                                </div>
                                <div class="ml-3">
                                    <p :class="step >= 2 ? 'text-indigo-600' : 'text-gray-500'" class="text-sm font-medium">Admin Account</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Step 1: Agency Information -->
                    <div x-show="step === 1">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Agency Information</h3>

                        <div class="grid grid-cols-1 gap-4">
                            <!-- Agency Name -->
                            <div>
                                <label for="agency_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-building mr-2 text-gray-400"></i>Agency Name
                                </label>
                                <input id="agency_name"
                                       type="text"
                                       name="agency_name"
                                       value="{{ old('agency_name') }}"
                                       required
                                       class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="Prime Properties Ltd">
                            </div>

                            <!-- Agency Slug -->
                            <div>
                                <label for="agency_slug" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-link mr-2 text-gray-400"></i>Agency URL Slug
                                </label>
                                <div class="flex">
                                    <input id="agency_slug"
                                           type="text"
                                           name="agency_slug"
                                           value="{{ old('agency_slug') }}"
                                           required
                                           class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-l-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                           placeholder="prime-properties">
                                    <span class="inline-flex items-center px-3 py-3 border border-l-0 border-gray-300 rounded-r-md bg-gray-50 text-gray-500 text-sm">
                                        .{{ parse_url(config('app.url'), PHP_URL_HOST) }}
                                    </span>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">This will be your agency's website URL</p>
                            </div>

                            <!-- Agency Email -->
                            <div>
                                <label for="agency_email" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-2 text-gray-400"></i>Agency Email
                                </label>
                                <input id="agency_email"
                                       type="email"
                                       name="agency_email"
                                       value="{{ old('agency_email') }}"
                                       required
                                       class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="info@primeproperties.com">
                            </div>

                            <!-- Agency Phone -->
                            <div>
                                <label for="agency_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-phone mr-2 text-gray-400"></i>Agency Phone
                                </label>
                                <input id="agency_phone"
                                       type="tel"
                                       name="agency_phone"
                                       value="{{ old('agency_phone') }}"
                                       required
                                       class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="+1234567890">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="button"
                                    @click="step = 2"
                                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Continue to Admin Account
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Admin Account -->
                    <div x-show="step === 2" style="display: none;">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Admin Account Details</h3>

                        <div class="grid grid-cols-1 gap-4">
                            <!-- Admin Name -->
                            <div>
                                <label for="admin_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user mr-2 text-gray-400"></i>Your Full Name
                                </label>
                                <input id="admin_name"
                                       type="text"
                                       name="admin_name"
                                       value="{{ old('admin_name') }}"
                                       required
                                       class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="John Doe">
                            </div>

                            <!-- Admin Email -->
                            <div>
                                <label for="admin_email" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-2 text-gray-400"></i>Your Email Address
                                </label>
                                <input id="admin_email"
                                       type="email"
                                       name="admin_email"
                                       value="{{ old('admin_email') }}"
                                       required
                                       class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="john@primeproperties.com">
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-lock mr-2 text-gray-400"></i>Password
                                </label>
                                <input id="password"
                                       type="password"
                                       name="password"
                                       required
                                       class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="••••••••">
                                <p class="mt-1 text-xs text-gray-500">Minimum 8 characters</p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-lock mr-2 text-gray-400"></i>Confirm Password
                                </label>
                                <input id="password_confirmation"
                                       type="password"
                                       name="password_confirmation"
                                       required
                                       class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="••••••••">
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="flex items-start">
                                <input id="terms"
                                       type="checkbox"
                                       name="terms"
                                       required
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mt-1">
                                <label for="terms" class="ml-2 block text-sm text-gray-900">
                                    I agree to the <a href="#" class="text-indigo-600 hover:text-indigo-500">Terms of Service</a> and <a href="#" class="text-indigo-600 hover:text-indigo-500">Privacy Policy</a>
                                </label>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <button type="button"
                                    @click="step = 1"
                                    class="flex justify-center py-3 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Back
                            </button>
                            <button type="submit"
                                    class="flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-check mr-2"></i>
                                Create Agency Account
                            </button>
                        </div>
                    </div>

                    <!-- Login Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account?
                            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Sign in
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
