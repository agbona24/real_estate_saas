<x-layouts.agency>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Agency Profile</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your agency information and settings</p>
            </div>
            <button
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Save Changes
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Settings Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <nav class="space-y-1 p-4">
                        <a href="{{ route('agency.settings.profile') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg bg-primary-50 dark:bg-primary-900 text-primary-700 dark:text-primary-300">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Agency Profile
                        </a>
                        <a href="{{ route('agency.settings.branding') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                            Branding
                        </a>
                        <a href="{{ route('agency.settings.subscription') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Subscription & Billing
                        </a>
                        <a href="{{ route('agency.settings.users') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            User Management
                        </a>
                        <a href="{{ route('agency.settings.payment') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Payment Settings
                        </a>
                        <a href="{{ route('agency.settings.security') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Security
                        </a>
                        <a href="{{ route('agency.settings.audit-logs') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Audit Logs
                        </a>
                        <a href="{{ route('agency.settings.notifications') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            Notifications
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Settings Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Basic Information</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Agency Logo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Agency Logo
                            </label>
                            <div class="flex items-center space-x-6">
                                <div class="flex-shrink-0">
                                    <div class="w-24 h-24 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center overflow-hidden">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <button type="button" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        Upload Logo
                                    </button>
                                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                        Recommended: 200x200px, PNG or JPG, max 2MB
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Agency Name -->
                        <div>
                            <label for="agency_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Agency Name <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="agency_name"
                                name="agency_name"
                                value="Premium Real Estate Agency"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            />
                        </div>

                        <!-- Tagline -->
                        <div>
                            <label for="tagline" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tagline
                            </label>
                            <input
                                type="text"
                                id="tagline"
                                name="tagline"
                                value="Your Dream Home Awaits"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                placeholder="E.g., Your Dream Home Awaits"
                            />
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Agency Description
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                placeholder="Tell us about your agency..."
                            >Premium Real Estate Agency is Lagos' leading property company, specializing in luxury residential and commercial properties across Nigeria.</textarea>
                        </div>

                        <!-- Registration Number & Year -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="reg_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Registration Number
                                </label>
                                <input
                                    type="text"
                                    id="reg_number"
                                    name="reg_number"
                                    value="RC 1234567"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                            <div>
                                <label for="year_established" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Year Established
                                </label>
                                <input
                                    type="number"
                                    id="year_established"
                                    name="year_established"
                                    value="2010"
                                    min="1900"
                                    max="2024"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Contact Information</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Email & Phone -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="info@premiumrealestate.ng"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    value="+234 803 456 7890"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                        </div>

                        <!-- Website & WhatsApp -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="website" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Website
                                </label>
                                <input
                                    type="url"
                                    id="website"
                                    name="website"
                                    value="https://premiumrealestate.ng"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                    placeholder="https://yourwebsite.com"
                                />
                            </div>
                            <div>
                                <label for="whatsapp" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    WhatsApp Business
                                </label>
                                <input
                                    type="tel"
                                    id="whatsapp"
                                    name="whatsapp"
                                    value="+234 803 456 7890"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Office Address <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                id="address"
                                name="address"
                                rows="2"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            >15, Adeola Odeku Street, Victoria Island, Lagos, Nigeria</textarea>
                        </div>

                        <!-- City, State, Country -->
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    City
                                </label>
                                <input
                                    type="text"
                                    id="city"
                                    name="city"
                                    value="Lagos"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    State
                                </label>
                                <input
                                    type="text"
                                    id="state"
                                    name="state"
                                    value="Lagos"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Country
                                </label>
                                <input
                                    type="text"
                                    id="country"
                                    name="country"
                                    value="Nigeria"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Social Media</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Facebook -->
                        <div>
                            <label for="facebook" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Facebook
                            </label>
                            <div class="flex">
                                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400 text-sm">
                                    facebook.com/
                                </span>
                                <input
                                    type="text"
                                    id="facebook"
                                    name="facebook"
                                    value="premiumrealestate"
                                    class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-r-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                        </div>

                        <!-- Twitter -->
                        <div>
                            <label for="twitter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Twitter/X
                            </label>
                            <div class="flex">
                                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400 text-sm">
                                    twitter.com/
                                </span>
                                <input
                                    type="text"
                                    id="twitter"
                                    name="twitter"
                                    value="premiumrealestate"
                                    class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-r-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div>
                            <label for="instagram" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Instagram
                            </label>
                            <div class="flex">
                                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400 text-sm">
                                    instagram.com/
                                </span>
                                <input
                                    type="text"
                                    id="instagram"
                                    name="instagram"
                                    value="premiumrealestate"
                                    class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-r-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                        </div>

                        <!-- LinkedIn -->
                        <div>
                            <label for="linkedin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                LinkedIn
                            </label>
                            <div class="flex">
                                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400 text-sm">
                                    linkedin.com/company/
                                </span>
                                <input
                                    type="text"
                                    id="linkedin"
                                    name="linkedin"
                                    value="premium-real-estate"
                                    class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-r-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Business Hours</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Weekdays -->
                        <div class="grid grid-cols-3 gap-4 items-center">
                            <div class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                Monday - Friday
                            </div>
                            <div>
                                <input
                                    type="time"
                                    value="09:00"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm"
                                />
                            </div>
                            <div>
                                <input
                                    type="time"
                                    value="18:00"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm"
                                />
                            </div>
                        </div>

                        <!-- Saturday -->
                        <div class="grid grid-cols-3 gap-4 items-center">
                            <div class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                Saturday
                            </div>
                            <div>
                                <input
                                    type="time"
                                    value="10:00"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm"
                                />
                            </div>
                            <div>
                                <input
                                    type="time"
                                    value="15:00"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm"
                                />
                            </div>
                        </div>

                        <!-- Sunday -->
                        <div class="grid grid-cols-3 gap-4 items-center">
                            <div class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                Sunday
                            </div>
                            <div class="col-span-2">
                                <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                                    <option value="closed">Closed</option>
                                    <option value="open">Open</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.agency>
