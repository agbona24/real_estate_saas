@extends('layouts.app')

@section('title', 'Properties Management')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-home mr-2 text-indigo-600"></i>
                Properties Management
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Manage all property listings and media
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-filter mr-2"></i>
                Filters
            </button>
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-download mr-2"></i>
                Export
            </button>
            <button onclick="window.location.href='{{ route('agency.properties.create') }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add Property
            </button>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow p-4 text-center cursor-pointer hover:shadow-md transition">
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] ?? 245 }}</p>
            <p class="text-xs text-gray-600">Total Properties</p>
        </div>
        <div class="bg-green-50 rounded-lg shadow p-4 text-center cursor-pointer hover:shadow-md transition">
            <p class="text-2xl font-bold text-green-900">{{ $stats['available'] ?? 178 }}</p>
            <p class="text-xs text-green-600">Available</p>
        </div>
        <div class="bg-blue-50 rounded-lg shadow p-4 text-center cursor-pointer hover:shadow-md transition">
            <p class="text-2xl font-bold text-blue-900">{{ $stats['sold'] ?? 45 }}</p>
            <p class="text-xs text-blue-600">Sold</p>
        </div>
        <div class="bg-purple-50 rounded-lg shadow p-4 text-center cursor-pointer hover:shadow-md transition">
            <p class="text-2xl font-bold text-purple-900">{{ $stats['rented'] ?? 18 }}</p>
            <p class="text-xs text-purple-600">Rented</p>
        </div>
        <div class="bg-yellow-50 rounded-lg shadow p-4 text-center cursor-pointer hover:shadow-md transition">
            <p class="text-2xl font-bold text-yellow-900">{{ $stats['draft'] ?? 12 }}</p>
            <p class="text-xs text-yellow-600">Draft</p>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="md:col-span-2">
                <input type="text" placeholder="Search properties..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option>All Categories</option>
                    <option>Land</option>
                    <option>Houses</option>
                    <option>Apartments</option>
                    <option>Commercial</option>
                    <option>Shortlet</option>
                    <option>Estates</option>
                </select>
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option>All Types</option>
                    <option>For Sale</option>
                    <option>For Rent</option>
                    <option>For Lease</option>
                    <option>Shortlet</option>
                </select>
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option>All Status</option>
                    <option>Available</option>
                    <option>Sold</option>
                    <option>Rented</option>
                    <option>Pending</option>
                    <option>Draft</option>
                </select>
            </div>
        </div>
    </div>

    <!-- View Toggle -->
    <div class="flex justify-between items-center">
        <div class="flex space-x-2" x-data="{ view: 'grid' }">
            <button @click="view = 'grid'" :class="view === 'grid' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700'" class="px-4 py-2 rounded-md border border-gray-300 hover:bg-indigo-50">
                <i class="fas fa-th-large"></i> Grid
            </button>
            <button @click="view = 'list'" :class="view === 'list' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700'" class="px-4 py-2 rounded-md border border-gray-300 hover:bg-indigo-50">
                <i class="fas fa-list"></i> List
            </button>
        </div>
        <div class="text-sm text-gray-600">
            Showing <span class="font-medium">1-12</span> of <span class="font-medium">{{ $stats['total'] ?? 245 }}</span> properties
        </div>
    </div>

    <!-- Properties Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($properties ?? [] as $property)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                <!-- Property Image -->
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ $property->image ?? 'https://via.placeholder.com/400x300' }}"
                         alt="{{ $property->title ?? 'Property' }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-300">

                    <!-- Status Badge -->
                    <div class="absolute top-2 left-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                            {{ ($property->status ?? 'available') === 'available' ? 'bg-green-600 text-white' : '' }}
                            {{ ($property->status ?? '') === 'sold' ? 'bg-blue-600 text-white' : '' }}
                            {{ ($property->status ?? '') === 'rented' ? 'bg-purple-600 text-white' : '' }}
                            {{ ($property->status ?? '') === 'draft' ? 'bg-gray-600 text-white' : '' }}">
                            {{ ucfirst($property->status ?? 'available') }}
                        </span>
                    </div>

                    <!-- Featured Badge -->
                    @if($property->is_featured ?? false)
                        <div class="absolute top-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-yellow-500 text-white">
                                <i class="fas fa-star mr-1"></i> Featured
                            </span>
                        </div>
                    @endif

                    <!-- Type Badge -->
                    <div class="absolute bottom-2 left-2">
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-white text-gray-800">
                            {{ ucfirst($property->type ?? 'sale') }}
                        </span>
                    </div>

                    <!-- Quick Actions -->
                    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                        <div class="flex flex-col space-y-1">
                            <button class="bg-white rounded-full p-2 shadow hover:bg-gray-100" title="Edit">
                                <i class="fas fa-edit text-blue-600"></i>
                            </button>
                            <button class="bg-white rounded-full p-2 shadow hover:bg-gray-100" title="Delete">
                                <i class="fas fa-trash text-red-600"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Property Details -->
                <div class="p-4">
                    <!-- Price -->
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-indigo-600">
                            ${{ number_format($property->price ?? 450000, 0) }}
                            @if(($property->type ?? 'sale') !== 'sale')
                                <span class="text-sm text-gray-500">/{{ $property->price_period ?? 'month' }}</span>
                            @endif
                        </h3>
                        <span class="text-xs px-2 py-1 bg-gray-100 text-gray-600 rounded">
                            {{ $property->category ?? 'House' }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h4 class="font-semibold text-gray-900 mb-2 line-clamp-1">
                        {{ $property->title ?? 'Luxury 4 Bedroom Villa' }}
                    </h4>

                    <!-- Location -->
                    <p class="text-sm text-gray-600 mb-3 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                        {{ $property->location ?? 'Beverly Hills, CA' }}
                    </p>

                    <!-- Features -->
                    <div class="grid grid-cols-3 gap-2 mb-3 text-center">
                        <div class="bg-gray-50 rounded p-2">
                            <i class="fas fa-bed text-gray-600 text-sm"></i>
                            <p class="text-xs font-medium text-gray-900 mt-1">{{ $property->bedrooms ?? 4 }}</p>
                        </div>
                        <div class="bg-gray-50 rounded p-2">
                            <i class="fas fa-bath text-gray-600 text-sm"></i>
                            <p class="text-xs font-medium text-gray-900 mt-1">{{ $property->bathrooms ?? 3 }}</p>
                        </div>
                        <div class="bg-gray-50 rounded p-2">
                            <i class="fas fa-ruler-combined text-gray-600 text-sm"></i>
                            <p class="text-xs font-medium text-gray-900 mt-1">{{ $property->area ?? 2500 }} sqft</p>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="flex justify-between items-center text-xs text-gray-500 mb-3 pt-3 border-t border-gray-200">
                        <span><i class="fas fa-eye mr-1"></i> {{ $property->views ?? 0 }} views</span>
                        <span><i class="fas fa-envelope mr-1"></i> {{ $property->inquiries ?? 0 }} inquiries</span>
                    </div>

                    <!-- Actions -->
                    <div class="grid grid-cols-2 gap-2">
                        <button onclick="window.location.href='{{ route('agency.properties.show', $property->id ?? 1) }}'"
                                class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md text-sm font-medium">
                            <i class="fas fa-eye mr-1"></i> View
                        </button>
                        <button onclick="window.location.href='{{ route('agency.properties.edit', $property->id ?? 1) }}'"
                                class="px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-medium">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </button>
                    </div>

                    <!-- Agent -->
                    <div class="mt-3 pt-3 border-t border-gray-200 flex items-center">
                        <img class="h-6 w-6 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($property->agent_name ?? 'Agent') }}" alt="">
                        <span class="ml-2 text-xs text-gray-600">{{ $property->agent_name ?? 'Agent Name' }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-white rounded-lg shadow">
                <i class="fas fa-home text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg font-medium">No properties found</p>
                <p class="text-gray-400 text-sm mt-1">Start by adding your first property listing</p>
                <button onclick="window.location.href='{{ route('agency.properties.create') }}'" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md">
                    <i class="fas fa-plus mr-2"></i>Add First Property
                </button>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="bg-white rounded-lg shadow px-4 py-3 flex items-center justify-between">
        <div class="flex-1 flex justify-between sm:hidden">
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous
            </a>
            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next
            </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">12</span> of{' '}
                    <span class="font-medium">{{ $stats['total'] ?? 245 }}</span> results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-indigo-50 text-sm font-medium text-indigo-600">1</a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
