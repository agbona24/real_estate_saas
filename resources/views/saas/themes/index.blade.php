@extends('layouts.dashboard')

@section('page-title', 'Themes Marketplace')

@section('page-content')
<!-- Header with Tabs -->
<div class="mb-6" x-data="{ tab: 'all' }">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div class="flex gap-2 border-b border-gray-200">
            <button @click="tab = 'all'" :class="tab === 'all' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="px-4 py-2 border-b-2 font-medium">
                All Themes
            </button>
            <button @click="tab = 'featured'" :class="tab === 'featured' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="px-4 py-2 border-b-2 font-medium">
                Featured
            </button>
            <button @click="tab = 'new'" :class="tab === 'new' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="px-4 py-2 border-b-2 font-medium">
                New
            </button>
        </div>
        <div class="flex gap-2">
            <input type="text" placeholder="Search themes..." class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Upload Theme
            </button>
        </div>
    </div>

    <!-- Themes Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Theme Card 1 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="relative">
                <div class="aspect-video bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                    <span class="text-white text-2xl font-bold">Modern Estate</span>
                </div>
                <span class="absolute top-3 right-3 px-2 py-1 bg-yellow-500 text-white text-xs font-semibold rounded">Featured</span>
            </div>
            <div class="p-5">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Modern Estate</h3>
                        <p class="text-sm text-gray-500">by ThemeStudio</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-900">4.8</span>
                        <span class="ml-1 text-sm text-gray-500">(124)</span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-4">A sleek and modern theme perfect for luxury real estate agencies. Fully responsive with dark mode.</p>
                <div class="flex gap-2 mb-4">
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Responsive</span>
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Dark Mode</span>
                    <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">SEO</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold text-gray-900">$79</span>
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm">Preview</button>
                        <button class="px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Edit</button>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">248 active installations</p>
            </div>
        </div>

        <!-- Theme Card 2 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="relative">
                <div class="aspect-video bg-gradient-to-br from-purple-400 to-pink-600 flex items-center justify-center">
                    <span class="text-white text-2xl font-bold">Luxury Living</span>
                </div>
                <span class="absolute top-3 right-3 px-2 py-1 bg-green-500 text-white text-xs font-semibold rounded">New</span>
            </div>
            <div class="p-5">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Luxury Living</h3>
                        <p class="text-sm text-gray-500">by DesignCo</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-900">4.9</span>
                        <span class="ml-1 text-sm text-gray-500">(89)</span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-4">Elegant design focused on high-end properties. Includes virtual tour integration and advanced filters.</p>
                <div class="flex gap-2 mb-4">
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Responsive</span>
                    <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded">VR Ready</span>
                    <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">SEO</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold text-gray-900">$99</span>
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm">Preview</button>
                        <button class="px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Edit</button>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">142 active installations</p>
            </div>
        </div>

        <!-- Theme Card 3 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="relative">
                <div class="aspect-video bg-gradient-to-br from-green-400 to-teal-600 flex items-center justify-center">
                    <span class="text-white text-2xl font-bold">Urban Nest</span>
                </div>
            </div>
            <div class="p-5">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Urban Nest</h3>
                        <p class="text-sm text-gray-500">by WebCraft</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-900">4.7</span>
                        <span class="ml-1 text-sm text-gray-500">(76)</span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-4">Perfect for urban properties and apartments. Clean design with focus on map integration.</p>
                <div class="flex gap-2 mb-4">
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Responsive</span>
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Maps</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold text-gray-900">$69</span>
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm">Preview</button>
                        <button class="px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Edit</button>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">196 active installations</p>
            </div>
        </div>

        <!-- Theme Card 4 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="relative">
                <div class="aspect-video bg-gradient-to-br from-orange-400 to-red-600 flex items-center justify-center">
                    <span class="text-white text-2xl font-bold">Coastal View</span>
                </div>
                <span class="absolute top-3 right-3 px-2 py-1 bg-yellow-500 text-white text-xs font-semibold rounded">Featured</span>
            </div>
            <div class="p-5">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Coastal View</h3>
                        <p class="text-sm text-gray-500">by OceanDesign</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-900">5.0</span>
                        <span class="ml-1 text-sm text-gray-500">(53)</span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-4">Beautiful theme designed for beachfront and vacation properties. Stunning image galleries.</p>
                <div class="flex gap-2 mb-4">
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Responsive</span>
                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded">Gallery</span>
                    <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">SEO</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold text-gray-900">$89</span>
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm">Preview</button>
                        <button class="px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Edit</button>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">167 active installations</p>
            </div>
        </div>

        <!-- Theme Card 5 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="relative">
                <div class="aspect-video bg-gradient-to-br from-indigo-400 to-blue-600 flex items-center justify-center">
                    <span class="text-white text-2xl font-bold">Minimalist Pro</span>
                </div>
            </div>
            <div class="p-5">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Minimalist Pro</h3>
                        <p class="text-sm text-gray-500">by MinimalStudio</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-900">4.6</span>
                        <span class="ml-1 text-sm text-gray-500">(42)</span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-4">Clean and minimalist design that puts your properties in the spotlight. Lightning fast.</p>
                <div class="flex gap-2 mb-4">
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Responsive</span>
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Fast</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold text-gray-900">$59</span>
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm">Preview</button>
                        <button class="px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Edit</button>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">98 active installations</p>
            </div>
        </div>

        <!-- Theme Card 6 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="relative">
                <div class="aspect-video bg-gradient-to-br from-pink-400 to-rose-600 flex items-center justify-center">
                    <span class="text-white text-2xl font-bold">Premium Plus</span>
                </div>
                <span class="absolute top-3 right-3 px-2 py-1 bg-green-500 text-white text-xs font-semibold rounded">New</span>
            </div>
            <div class="p-5">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Premium Plus</h3>
                        <p class="text-sm text-gray-500">by EliteThemes</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-900">4.8</span>
                        <span class="ml-1 text-sm text-gray-500">(31)</span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-4">All-in-one premium theme with every feature you need. Regular updates included.</p>
                <div class="flex gap-2 mb-4">
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Responsive</span>
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Dark Mode</span>
                    <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">SEO</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold text-gray-900">$119</span>
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm">Preview</button>
                        <button class="px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Edit</button>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">64 active installations</p>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
