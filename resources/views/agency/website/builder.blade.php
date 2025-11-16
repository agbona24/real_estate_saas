@extends('layouts.app')

@section('title', 'Website Builder')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-paint-brush mr-2 text-indigo-600"></i>
                Website Builder
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Customize your agency's public website
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-eye mr-2"></i>
                Preview Site
            </button>
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-save mr-2"></i>
                Save Changes
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Pages</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['pages'] ?? 8 }}</p>
                </div>
                <i class="fas fa-file text-blue-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Blog Posts</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['posts'] ?? 12 }}</p>
                </div>
                <i class="fas fa-blog text-green-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Site Visits</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['visits'] ?? '2.4K' }}</p>
                </div>
                <i class="fas fa-chart-line text-purple-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Inquiries</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['inquiries'] ?? 45 }}</p>
                </div>
                <i class="fas fa-envelope text-yellow-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Main Builder Interface -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Theme Selection -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-palette mr-2 text-gray-600"></i>
                        Choose Your Theme
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($themes ?? [] as $theme)
                            <div class="border-2 {{ ($theme->is_active ?? false) ? 'border-indigo-600' : 'border-gray-200' }} rounded-lg overflow-hidden hover:shadow-lg transition cursor-pointer">
                                <div class="relative">
                                    <img src="{{ $theme->thumbnail ?? 'https://via.placeholder.com/600x400' }}" alt="{{ $theme->name ?? 'Theme' }}" class="w-full h-48 object-cover">
                                    @if($theme->is_active ?? false)
                                        <div class="absolute top-2 right-2">
                                            <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                                <i class="fas fa-check mr-1"></i> Active
                                            </span>
                                        </div>
                                    @endif
                                    @if($theme->is_premium ?? false)
                                        <div class="absolute top-2 left-2">
                                            <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                                <i class="fas fa-crown mr-1"></i> Premium
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-1">{{ $theme->name ?? 'Modern Theme' }}</h3>
                                    <p class="text-sm text-gray-600 mb-3">{{ $theme->description ?? 'Clean and modern design for real estate agencies' }}</p>
                                    <div class="flex justify-between items-center">
                                        @if($theme->is_active ?? false)
                                            <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                                                <i class="fas fa-cog mr-1"></i> Customize
                                            </button>
                                        @else
                                            <button class="text-sm text-gray-600 hover:text-gray-800 font-medium">
                                                <i class="fas fa-eye mr-1"></i> Preview
                                            </button>
                                        @endif
                                        <button class="px-4 py-1 {{ ($theme->is_active ?? false) ? 'bg-gray-200 text-gray-600' : 'bg-indigo-600 hover:bg-indigo-700 text-white' }} rounded text-sm font-medium">
                                            {{ ($theme->is_active ?? false) ? 'Active' : 'Activate' }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Page Management -->
            <div class="bg-white rounded-lg shadow mt-6">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-file mr-2 text-gray-600"></i>
                        Pages
                    </h2>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm">
                        <i class="fas fa-plus mr-1"></i> New Page
                    </button>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @forelse($pages ?? [] as $page)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex items-center">
                                    <i class="fas fa-{{ $page->icon ?? 'file' }} text-gray-400 mr-3"></i>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $page->title ?? 'Home' }}</p>
                                        <p class="text-xs text-gray-500">/{{ $page->slug ?? 'home' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs px-2 py-1 rounded {{ ($page->is_published ?? false) ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ($page->is_published ?? false) ? 'Published' : 'Draft' }}
                                    </span>
                                    <button class="text-blue-600 hover:text-blue-700 p-1">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-700 p-1">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No pages created yet</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Panel -->
        <div class="space-y-6">
            <!-- Theme Customization -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-cog mr-2 text-gray-600"></i>
                        Theme Settings
                    </h2>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Logo Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Logo
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                            <img src="https://via.placeholder.com/150" alt="Logo" class="mx-auto h-16 mb-2">
                            <input type="file" class="hidden" id="logo">
                            <label for="logo" class="text-sm text-indigo-600 hover:text-indigo-700 cursor-pointer">
                                Change Logo
                            </label>
                        </div>
                    </div>

                    <!-- Colors -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Primary Color
                        </label>
                        <div class="flex space-x-2">
                            <input type="color" value="#4F46E5" class="h-10 w-20 border border-gray-300 rounded">
                            <input type="text" value="#4F46E5" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Secondary Color
                        </label>
                        <div class="flex space-x-2">
                            <input type="color" value="#10B981" class="h-10 w-20 border border-gray-300 rounded">
                            <input type="text" value="#10B981" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                        </div>
                    </div>

                    <!-- Typography -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Font Family
                        </label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <option>Inter</option>
                            <option>Poppins</option>
                            <option>Roboto</option>
                            <option>Open Sans</option>
                        </select>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Phone
                        </label>
                        <input type="tel" value="+1234567890" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input type="email" value="info@agency.com" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                    </div>

                    <!-- Social Media -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Social Links
                        </label>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <i class="fab fa-facebook text-blue-600 w-5"></i>
                                <input type="url" placeholder="Facebook URL" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fab fa-twitter text-blue-400 w-5"></i>
                                <input type="url" placeholder="Twitter URL" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fab fa-instagram text-pink-600 w-5"></i>
                                <input type="url" placeholder="Instagram URL" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-search mr-2 text-gray-600"></i>
                        SEO Settings
                    </h2>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Title
                        </label>
                        <input type="text" placeholder="Your Agency Name - Real Estate" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Description
                        </label>
                        <textarea rows="3" placeholder="Describe your agency..." class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Keywords
                        </label>
                        <input type="text" placeholder="real estate, properties, houses" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
