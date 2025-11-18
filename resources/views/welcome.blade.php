<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RealEstate Pro - Modern Real Estate Management Platform</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900|poppins:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        accent: {
                            500: '#8b5cf6',
                            600: '#7c3aed',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'slide-right': 'slideRight 0.6s ease-out',
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slow': 'bounce 3s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(100px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideRight: {
                            '0%': { transform: 'translateX(-100px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        }
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

        .gradient-border {
            position: relative;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, #667eea, #764ba2) border-box;
            border: 2px solid transparent;
        }

        .mesh-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="antialiased font-sans overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300" x-data="{ scrolled: false, mobileMenu: false }"
         @scroll.window="scrolled = window.pageYOffset > 50"
         :class="scrolled ? 'bg-white shadow-lg' : 'bg-transparent'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3 animate-slide-right">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-accent-600 flex items-center justify-center shadow-lg">
                        <i class="fas fa-building text-white text-2xl"></i>
                    </div>
                    <span class="text-2xl font-display font-bold" :class="scrolled ? 'text-gray-900' : 'text-white'">
                        RealEstate<span class="gradient-text">Pro</span>
                    </span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="font-medium transition-colors" :class="scrolled ? 'text-gray-700 hover:text-primary-600' : 'text-white hover:text-primary-200'">Features</a>
                    <a href="#benefits" class="font-medium transition-colors" :class="scrolled ? 'text-gray-700 hover:text-primary-600' : 'text-white hover:text-primary-200'">Benefits</a>
                    <a href="#pricing" class="font-medium transition-colors" :class="scrolled ? 'text-gray-700 hover:text-primary-600' : 'text-white hover:text-primary-200'">Pricing</a>
                    <a href="#testimonials" class="font-medium transition-colors" :class="scrolled ? 'text-gray-700 hover:text-primary-600' : 'text-white hover:text-primary-200'">Testimonials</a>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-500 to-accent-600 text-white font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ Route::has('login') ? route('login') : '#login' }}" class="font-medium transition-colors" :class="scrolled ? 'text-gray-700 hover:text-primary-600' : 'text-white hover:text-primary-200'">Log in</a>
                            <a href="{{ Route::has('register') ? route('register') : '#register' }}" class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-500 to-accent-600 text-white font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                                Get Started Free
                            </a>
                        @endauth
                    @else
                        <a href="#login" class="font-medium transition-colors" :class="scrolled ? 'text-gray-700 hover:text-primary-600' : 'text-white hover:text-primary-200'">Log in</a>
                        <a href="#register" class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-500 to-accent-600 text-white font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                            Get Started Free
                        </a>
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" class="md:hidden" :class="scrolled ? 'text-gray-900' : 'text-white'">
                    <i class="fas text-2xl" :class="mobileMenu ? 'fa-times' : 'fa-bars'"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenu" x-transition class="md:hidden bg-white shadow-lg">
            <div class="px-4 py-6 space-y-4">
                <a href="#features" class="block text-gray-700 hover:text-primary-600 font-medium">Features</a>
                <a href="#benefits" class="block text-gray-700 hover:text-primary-600 font-medium">Benefits</a>
                <a href="#pricing" class="block text-gray-700 hover:text-primary-600 font-medium">Pricing</a>
                <a href="#testimonials" class="block text-gray-700 hover:text-primary-600 font-medium">Testimonials</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-500 to-accent-600 text-white font-semibold text-center">Dashboard</a>
                    @else
                        <a href="{{ Route::has('login') ? route('login') : '#login' }}" class="block text-gray-700 hover:text-primary-600 font-medium">Log in</a>
                        <a href="{{ Route::has('register') ? route('register') : '#register' }}" class="block px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-500 to-accent-600 text-white font-semibold text-center">Get Started Free</a>
                    @endauth
                @else
                    <a href="#login" class="block text-gray-700 hover:text-primary-600 font-medium">Log in</a>
                    <a href="#register" class="block px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-500 to-accent-600 text-white font-semibold text-center">Get Started Free</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-primary-600 via-accent-600 to-purple-700">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-primary-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute -bottom-8 left-40 w-72 h-72 bg-pink-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>

            <!-- Grid Pattern -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00em0wLTEwYzAtMi4yMS0xLjc5LTQtNC00cy00IDEuNzktNCA0IDEuNzkgNCA0IDQgNC0xLjc5IDQtNHptMC0xMGMwLTIuMjEtMS43OS00LTQtNHMtNCAxLjc5LTQgNCAxLjc5IDQgNCA0IDQtMS43OSA0LTR6bTEwIDIwYzAtMi4yMS0xLjc5LTQtNC00cy00IDEuNzktNCA0IDEuNzkgNCA0IDQgNC0xLjc5IDQtNHptMC0xMGMwLTIuMjEtMS43OS00LTQtNHMtNCAxLjc5LTQgNCAxLjc5IDQgNCA0IDQtMS43OSA0LTR6bTAtMTBjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00em0xMCAyMGMwLTIuMjEtMS43OS00LTQtNHMtNCAxLjc5LTQgNCAxLjc5IDQgNCA0IDQtMS43OSA0LTR6bTAtMTBjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00em0wLTEwYzAtMi4yMS0xLjc5LTQtNC00cy00IDEuNzktNCA0IDEuNzkgNCA0IDQgNC0xLjc5IDQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-10"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 text-center">
            <div class="animate-slide-up">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-white mb-8">
                    <span class="relative flex h-2 w-2 mr-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-sm font-medium">Now with AI-Powered Analytics</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-5xl md:text-7xl font-display font-black text-white mb-6 leading-tight">
                    Transform Your<br>
                    Real Estate Business
                </h1>

                <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-3xl mx-auto font-light">
                    The most powerful all-in-one platform for modern real estate agencies. Manage properties, clients, transactions, and grow your business effortlessly.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                    <a href="{{ Route::has('register') ? route('register') : '#register' }}" class="group px-8 py-4 bg-white text-primary-600 rounded-xl font-bold text-lg shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all flex items-center space-x-2">
                        <span>Start Free Trial</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="#demo" class="px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-xl font-bold text-lg border-2 border-white/30 hover:bg-white/20 transition-all flex items-center space-x-2">
                        <i class="fas fa-play"></i>
                        <span>Watch Demo</span>
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="flex flex-wrap justify-center items-center gap-8 text-white/80">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span>No credit card required</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-users text-blue-400"></i>
                        <span>10,000+ agencies trust us</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-star text-yellow-400"></i>
                        <span>4.9/5 rating</span>
                    </div>
                </div>
            </div>

            <!-- Hero Image/Mockup -->
            <div class="mt-20 animate-fade-in" style="animation-delay: 0.3s;">
                <div class="relative mx-auto max-w-5xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-transparent via-primary-500/20 to-transparent blur-3xl"></div>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-white/20 backdrop-blur-sm">
                        <div class="bg-gradient-to-br from-gray-900 to-gray-800 p-8">
                            <!-- Browser Mockup -->
                            <div class="flex items-center space-x-2 mb-4">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            </div>
                            <div class="bg-white rounded-lg p-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="space-y-2 flex-1">
                                        <div class="h-4 bg-gradient-to-r from-primary-400 to-accent-500 rounded w-1/3"></div>
                                        <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                                    </div>
                                    <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-primary-500 to-accent-600"></div>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="h-24 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg"></div>
                                    <div class="h-24 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg"></div>
                                    <div class="h-24 bg-gradient-to-br from-pink-100 to-pink-200 rounded-lg"></div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-3 bg-gray-200 rounded"></div>
                                    <div class="h-3 bg-gray-200 rounded w-5/6"></div>
                                    <div class="h-3 bg-gray-200 rounded w-4/6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <i class="fas fa-chevron-down text-white text-2xl"></i>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="space-y-2">
                    <div class="text-5xl font-black gradient-text font-display">500K+</div>
                    <div class="text-gray-600 font-medium">Properties Managed</div>
                </div>
                <div class="space-y-2">
                    <div class="text-5xl font-black gradient-text font-display">10K+</div>
                    <div class="text-gray-600 font-medium">Active Agencies</div>
                </div>
                <div class="space-y-2">
                    <div class="text-5xl font-black gradient-text font-display">$2.5B+</div>
                    <div class="text-gray-600 font-medium">Transactions Processed</div>
                </div>
                <div class="space-y-2">
                    <div class="text-5xl font-black gradient-text font-display">99.9%</div>
                    <div class="text-gray-600 font-medium">Uptime Guarantee</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full font-semibold text-sm mb-4">
                    POWERFUL FEATURES
                </div>
                <h2 class="text-4xl md:text-5xl font-display font-black text-gray-900 mb-4">
                    Everything You Need To<br>
                    <span class="gradient-text">Dominate Real Estate</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Built for modern agencies with cutting-edge tools and automation
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-building text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Property Management</h3>
                    <p class="text-gray-600 mb-4">
                        Manage unlimited properties with advanced search, filtering, and categorization. Upload photos, videos, and 3D tours.
                    </p>
                    <a href="#" class="text-primary-600 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition-transform">
                        <span>Learn more</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Feature Card 2 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">CRM & Lead Management</h3>
                    <p class="text-gray-600 mb-4">
                        Track every lead, client interaction, and deal. Automated follow-ups and intelligent lead scoring included.
                    </p>
                    <a href="#" class="text-primary-600 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition-transform">
                        <span>Learn more</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Feature Card 3 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-file-signature text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Digital Signatures</h3>
                    <p class="text-gray-600 mb-4">
                        Close deals faster with legally-binding e-signatures. No more printing, scanning, or mailing contracts.
                    </p>
                    <a href="#" class="text-primary-600 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition-transform">
                        <span>Learn more</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Feature Card 4 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Advanced Analytics</h3>
                    <p class="text-gray-600 mb-4">
                        Real-time dashboards with AI-powered insights. Track sales, revenue, agent performance, and market trends.
                    </p>
                    <a href="#" class="text-primary-600 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition-transform">
                        <span>Learn more</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Feature Card 5 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-wallet text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Payment Processing</h3>
                    <p class="text-gray-600 mb-4">
                        Integrated payment gateway with milestone tracking, automated receipts, and multi-currency support.
                    </p>
                    <a href="#" class="text-primary-600 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition-transform">
                        <span>Learn more</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Feature Card 6 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-warehouse text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Estate Inventory</h3>
                    <p class="text-gray-600 mb-4">
                        Auto-track plot allocations, prevent over-selling, manage reservations with expiry, and visualize site maps.
                    </p>
                    <a href="#" class="text-primary-600 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition-transform">
                        <span>Learn more</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Left Content -->
                <div>
                    <div class="inline-block px-4 py-2 bg-accent-100 text-accent-700 rounded-full font-semibold text-sm mb-4">
                        WHY CHOOSE US
                    </div>
                    <h2 class="text-4xl md:text-5xl font-display font-black text-gray-900 mb-6">
                        Built For Real Estate<br>
                        <span class="gradient-text">Professionals</span>
                    </h2>
                    <p class="text-xl text-gray-600 mb-8">
                        We understand your business because we work with thousands of agencies worldwide.
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-1">Save 20+ Hours Per Week</h4>
                                <p class="text-gray-600">Automate repetitive tasks and focus on closing deals instead of paperwork.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-1">Increase Revenue by 40%</h4>
                                <p class="text-gray-600">Better lead management and follow-ups mean more conversions and higher sales.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-1">Enterprise-Grade Security</h4>
                                <p class="text-gray-600">Bank-level encryption, regular backups, and 99.9% uptime SLA guaranteed.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check text-pink-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-1">24/7 Support & Training</h4>
                                <p class="text-gray-600">Dedicated success team, live chat support, and comprehensive video tutorials.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Illustration -->
                <div class="relative">
                    <div class="absolute top-0 right-0 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float"></div>
                    <div class="absolute bottom-0 left-0 w-72 h-72 bg-primary-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float" style="animation-delay: 2s;"></div>

                    <div class="relative bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">
                        <div class="space-y-6">
                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-trophy text-white"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-600">Monthly Sales</div>
                                        <div class="text-2xl font-bold text-gray-900">$2.4M</div>
                                    </div>
                                </div>
                                <div class="text-green-600 font-bold text-lg">+32%</div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 bg-blue-50 rounded-xl">
                                    <div class="text-3xl font-black text-blue-600">142</div>
                                    <div class="text-sm text-gray-600">Active Listings</div>
                                </div>
                                <div class="p-4 bg-purple-50 rounded-xl">
                                    <div class="text-3xl font-black text-purple-600">89</div>
                                    <div class="text-sm text-gray-600">New Leads</div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Deal Closure Rate</span>
                                    <span class="text-sm font-bold text-gray-900">87%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-primary-500 to-accent-600 h-2 rounded-full" style="width: 87%"></div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-xl">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-star text-yellow-500 text-2xl"></i>
                                    <div>
                                        <div class="text-sm text-gray-600">Customer Rating</div>
                                        <div class="text-lg font-bold text-gray-900">4.9/5.0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full font-semibold text-sm mb-4">
                    PRICING PLANS
                </div>
                <h2 class="text-4xl md:text-5xl font-display font-black text-gray-900 mb-4">
                    Simple, Transparent Pricing
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Choose the perfect plan for your agency. All plans include 14-day free trial.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto" x-data="{ billingCycle: 'monthly' }">
                <!-- Billing Toggle -->
                <div class="md:col-span-3 flex justify-center mb-8">
                    <div class="bg-gray-100 p-1 rounded-xl inline-flex">
                        <button @click="billingCycle = 'monthly'"
                                :class="billingCycle === 'monthly' ? 'bg-white shadow-md' : 'bg-transparent'"
                                class="px-6 py-2 rounded-lg font-semibold transition-all">
                            Monthly
                        </button>
                        <button @click="billingCycle = 'annual'"
                                :class="billingCycle === 'annual' ? 'bg-white shadow-md' : 'bg-transparent'"
                                class="px-6 py-2 rounded-lg font-semibold transition-all">
                            Annual <span class="text-green-600 text-xs ml-1">(Save 20%)</span>
                        </button>
                    </div>
                </div>

                <!-- Starter Plan -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border-2 border-gray-200 hover:border-primary-500 transition-all">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Starter</h3>
                        <p class="text-gray-600 mb-6">Perfect for small agencies</p>
                        <div class="mb-2">
                            <span class="text-5xl font-black text-gray-900" x-text="billingCycle === 'monthly' ? '$49' : '$39'"></span>
                            <span class="text-gray-600">/month</span>
                        </div>
                        <p class="text-sm text-gray-500" x-show="billingCycle === 'annual'">Billed annually at $468</p>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span class="text-gray-700">Up to 50 properties</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span class="text-gray-700">3 team members</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span class="text-gray-700">CRM & Lead Management</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span class="text-gray-700">Basic Analytics</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span class="text-gray-700">Email Support</span>
                        </li>
                    </ul>

                    <a href="{{ Route::has('register') ? route('register') : '#register' }}" class="block w-full text-center px-6 py-3 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition-colors">
                        Start Free Trial
                    </a>
                </div>

                <!-- Professional Plan (Most Popular) -->
                <div class="bg-gradient-to-br from-primary-600 to-accent-600 rounded-2xl p-8 shadow-2xl transform scale-105 relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-gray-900 px-4 py-1 rounded-full text-sm font-bold">
                        MOST POPULAR
                    </div>

                    <div class="text-center mb-8 text-white">
                        <h3 class="text-2xl font-bold mb-2">Professional</h3>
                        <p class="text-white/80 mb-6">For growing agencies</p>
                        <div class="mb-2">
                            <span class="text-5xl font-black" x-text="billingCycle === 'monthly' ? '$99' : '$79'"></span>
                            <span class="text-white/80">/month</span>
                        </div>
                        <p class="text-sm text-white/70" x-show="billingCycle === 'annual'">Billed annually at $948</p>
                    </div>

                    <ul class="space-y-4 mb-8 text-white">
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check mt-1"></i>
                            <span>Unlimited properties</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check mt-1"></i>
                            <span>10 team members</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check mt-1"></i>
                            <span>Advanced CRM & Automation</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check mt-1"></i>
                            <span>AI-Powered Analytics</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check mt-1"></i>
                            <span>E-Signature & Documents</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check mt-1"></i>
                            <span>Priority Support</span>
                        </li>
                    </ul>

                    <a href="{{ Route::has('register') ? route('register') : '#register' }}" class="block w-full text-center px-6 py-3 bg-white text-primary-600 rounded-xl font-bold hover:bg-gray-50 transition-colors">
                        Start Free Trial
                    </a>
                </div>

                <!-- Enterprise Plan -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border-2 border-gray-200 hover:border-primary-500 transition-all">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Enterprise</h3>
                        <p class="text-gray-600 mb-6">For large organizations</p>
                        <div class="mb-2">
                            <span class="text-5xl font-black text-gray-900">Custom</span>
                        </div>
                        <p class="text-sm text-gray-500">Contact for pricing</p>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span class="text-gray-700">Everything in Professional</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span class="text-gray-700">Unlimited team members</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span class="text-gray-700">Custom integrations</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span class="text-gray-700">Dedicated account manager</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span class="text-gray-700">24/7 Phone Support</span>
                        </li>
                    </ul>

                    <a href="#contact" class="block w-full text-center px-6 py-3 bg-gray-900 text-white rounded-xl font-bold hover:bg-gray-800 transition-colors">
                        Contact Sales
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-block px-4 py-2 bg-accent-100 text-accent-700 rounded-full font-semibold text-sm mb-4">
                    TESTIMONIALS
                </div>
                <h2 class="text-4xl md:text-5xl font-display font-black text-gray-900 mb-4">
                    Loved By Agencies<br>
                    <span class="gradient-text">Worldwide</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    See what real estate professionals say about RealEstatePro
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6 italic">
                        "RealEstatePro transformed our agency. We've increased our sales by 45% and cut administrative work in half. The estate inventory feature alone saved us from a major overselling disaster!"
                    </p>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                            SM
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">Sarah Mitchell</div>
                            <div class="text-sm text-gray-600">CEO, Prime Properties</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6 italic">
                        "The automation features are incredible. Our team spends less time on paperwork and more time building relationships. The ROI was immediate and significant."
                    </p>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold">
                            JC
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">James Chen</div>
                            <div class="text-sm text-gray-600">Founder, Urban Realty</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6 italic">
                        "Best investment we've made for our agency. The analytics dashboard gives us insights we never had before. Customer support is outstanding - always there when we need them."
                    </p>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-rose-600 rounded-full flex items-center justify-center text-white font-bold">
                            MR
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">Maria Rodriguez</div>
                            <div class="text-sm text-gray-600">Director, Skyline Estates</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-br from-primary-600 via-accent-600 to-purple-700 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00em0wLTEwYzAtMi4yMS0xLjc5LTQtNC00cy00IDEuNzktNCA0IDEuNzkgNCA0IDQgNC0xLjc5IDQtNHptMC0xMGMwLTIuMjEtMS43OS00LTQtNHMtNCAxLjc5LTQgNCAxLjc5IDQgNCA0IDQtMS43OSA0LTR6bTEwIDIwYzAtMi4yMS0xLjc5LTQtNC00cy00IDEuNzktNCA0IDEuNzkgNCA0IDQgNC0xLjc5IDQtNHptMC0xMGMwLTIuMjEtMS43OS00LTQtNHMtNCAxLjc5LTQgNCAxLjc5IDQgNCA0IDQtMS43OSA0LTR6bTAtMTBjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00em0xMCAyMGMwLTIuMjEtMS43OS00LTQtNHMtNCAxLjc5LTQgNCAxLjc5IDQgNCA0IDQtMS43OSA0LTR6bTAtMTBjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00em0wLTEwYzAtMi4yMS0xLjc5LTQtNC00cy00IDEuNzktNCA0IDEuNzkgNCA0IDQgNC0xLjc5IDQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-10"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-4xl md:text-6xl font-display font-black text-white mb-6">
                Ready To Transform Your<br>Real Estate Business?
            </h2>
            <p class="text-xl text-white/90 mb-12 max-w-2xl mx-auto">
                Join 10,000+ agencies already using RealEstatePro. Start your 14-day free trial today - no credit card required.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ Route::has('register') ? route('register') : '#register' }}" class="group px-10 py-5 bg-white text-primary-600 rounded-xl font-bold text-lg shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all flex items-center space-x-2">
                    <span>Start Free Trial</span>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="#demo" class="px-10 py-5 bg-white/10 backdrop-blur-sm text-white rounded-xl font-bold text-lg border-2 border-white/30 hover:bg-white/20 transition-all flex items-center space-x-2">
                    <i class="fas fa-calendar"></i>
                    <span>Schedule Demo</span>
                </a>
            </div>

            <div class="mt-12 flex flex-wrap justify-center items-center gap-8 text-white/80">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-shield-alt text-green-400"></i>
                    <span>SOC 2 Certified</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-lock text-blue-400"></i>
                    <span>Bank-Level Security</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-headset text-purple-400"></i>
                    <span>24/7 Support</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <!-- Company Info -->
                <div class="col-span-1">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary-500 to-accent-600 flex items-center justify-center">
                            <i class="fas fa-building text-white"></i>
                        </div>
                        <span class="text-xl font-display font-bold text-white">RealEstate<span class="gradient-text">Pro</span></span>
                    </div>
                    <p class="text-gray-400 mb-4">
                        The most powerful all-in-one platform for modern real estate agencies.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Product -->
                <div>
                    <h4 class="text-white font-bold mb-4">Product</h4>
                    <ul class="space-y-3">
                        <li><a href="#features" class="hover:text-white transition-colors">Features</a></li>
                        <li><a href="#pricing" class="hover:text-white transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Integrations</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">API</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Changelog</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="text-white font-bold mb-4">Company</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Press Kit</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div>
                    <h4 class="text-white font-bold mb-4">Resources</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Video Tutorials</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Community</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Status</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">
                    &copy; 2024 RealEstatePro. All rights reserved.
                </p>
                <div class="flex space-x-6 text-sm">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-white transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Smooth Scroll -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '#demo' && href !== '#contact') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    </script>
</body>
</html>
