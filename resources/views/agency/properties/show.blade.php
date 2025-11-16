@extends('layouts.app')

@section('title', 'Property Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-start">
        <div class="flex items-start space-x-4">
            <button onclick="window.history.back()" class="text-gray-600 hover:text-gray-900 mt-1">
                <i class="fas fa-arrow-left text-xl"></i>
            </button>
            <div>
                <div class="flex items-center space-x-3 mb-2">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $property->title ?? 'Luxury 4 Bedroom Villa' }}</h1>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ ($property->status ?? 'available') === 'available' ? 'bg-green-100 text-green-800' : '' }}
                        {{ ($property->status ?? '') === 'sold' ? 'bg-gray-100 text-gray-800' : '' }}
                        {{ ($property->status ?? '') === 'rented' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ ($property->status ?? '') === 'draft' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                        {{ ucfirst($property->status ?? 'available') }}
                    </span>
                    @if($property->featured ?? false)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            <i class="fas fa-star mr-1"></i> Featured
                        </span>
                    @endif
                </div>
                <div class="flex items-center space-x-4 text-sm text-gray-600">
                    <span><i class="fas fa-map-marker-alt mr-1"></i> {{ $property->address ?? 'Beverly Hills, CA 90210' }}</span>
                    <span><i class="fas fa-calendar mr-1"></i> Listed {{ $property->listed_date ?? 'Nov 1, 2025' }}</span>
                    <span><i class="fas fa-eye mr-1"></i> {{ $property->views ?? 234 }} views</span>
                </div>
            </div>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md">
                <i class="fas fa-share-alt mr-2"></i>
                Share
            </button>
            <button onclick="window.location.href='{{ route('agency.properties.edit', $property->id ?? 1) }}'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                <i class="fas fa-edit mr-2"></i>
                Edit
            </button>
        </div>
    </div>

    <!-- Price and Quick Stats -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm opacity-90">{{ ($property->listing_type ?? 'sale') === 'sale' ? 'Price' : 'Rental Price' }}</p>
                <p class="text-4xl font-bold">${{ number_format($property->price ?? 450000, 0) }}</p>
                @if(($property->listing_type ?? 'sale') !== 'sale')
                    <p class="text-sm opacity-90 mt-1">per {{ $property->price_period ?? 'month' }}</p>
                @endif
            </div>
            <div class="grid grid-cols-4 gap-6 text-center">
                <div>
                    <i class="fas fa-bed text-2xl mb-2"></i>
                    <p class="text-2xl font-bold">{{ $property->bedrooms ?? 4 }}</p>
                    <p class="text-xs opacity-90">Bedrooms</p>
                </div>
                <div>
                    <i class="fas fa-bath text-2xl mb-2"></i>
                    <p class="text-2xl font-bold">{{ $property->bathrooms ?? 3 }}</p>
                    <p class="text-xs opacity-90">Bathrooms</p>
                </div>
                <div>
                    <i class="fas fa-ruler-combined text-2xl mb-2"></i>
                    <p class="text-2xl font-bold">{{ number_format($property->size ?? 2500) }}</p>
                    <p class="text-xs opacity-90">Sq Ft</p>
                </div>
                <div>
                    <i class="fas fa-car text-2xl mb-2"></i>
                    <p class="text-2xl font-bold">{{ $property->parking ?? 2 }}</p>
                    <p class="text-xs opacity-90">Parking</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Image Gallery -->
            <div class="bg-white rounded-lg shadow overflow-hidden" x-data="{ currentImage: 0 }">
                <div class="relative h-96 bg-gray-200">
                    @foreach($property->images ?? [] as $index => $image)
                        <img x-show="currentImage === {{ $index }}" src="{{ $image }}" class="w-full h-full object-cover" alt="Property Image {{ $index + 1 }}">
                    @endforeach

                    <!-- Navigation Arrows -->
                    <button @click="currentImage = currentImage > 0 ? currentImage - 1 : {{ count($property->images ?? []) - 1 }}" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white p-3 rounded-full">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button @click="currentImage = currentImage < {{ count($property->images ?? []) - 1 }} ? currentImage + 1 : 0" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white p-3 rounded-full">
                        <i class="fas fa-chevron-right"></i>
                    </button>

                    <!-- Image Counter -->
                    <div class="absolute bottom-4 right-4 bg-black bg-opacity-75 text-white px-3 py-1 rounded-full text-sm">
                        <span x-text="currentImage + 1"></span> / {{ count($property->images ?? []) }}
                    </div>
                </div>

                <!-- Thumbnail Strip -->
                <div class="grid grid-cols-6 gap-2 p-4 bg-gray-50">
                    @foreach($property->images ?? [] as $index => $image)
                        <img @click="currentImage = {{ $index }}" src="{{ $image }}"
                             :class="currentImage === {{ $index }} ? 'ring-2 ring-indigo-600' : ''"
                             class="w-full h-16 object-cover rounded cursor-pointer hover:opacity-75 transition"
                             alt="Thumbnail {{ $index + 1 }}">
                    @endforeach
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Description</h2>
                <div class="prose max-w-none text-gray-700">
                    <p>{{ $property->description ?? 'Stunning luxury villa located in the heart of Beverly Hills. This magnificent property features 4 spacious bedrooms, 3 modern bathrooms, and over 2,500 square feet of living space. The open-concept design seamlessly blends indoor and outdoor living, perfect for entertaining guests or relaxing with family.' }}</p>
                    <p class="mt-4">{{ $property->description_extra ?? 'The gourmet kitchen is equipped with top-of-the-line appliances, granite countertops, and custom cabinetry. Large windows throughout the home flood the space with natural light and offer breathtaking views of the surrounding hills. The master suite includes a walk-in closet and spa-like bathroom with dual vanities and a soaking tub.' }}</p>
                </div>
            </div>

            <!-- Features & Amenities -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Features & Amenities</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($property->amenities ?? ['Swimming Pool', 'Garden', 'Gym', 'Balcony', 'Air Conditioning', 'Central Heating', 'WiFi', 'Security System', 'Fireplace'] as $amenity)
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-sm text-gray-700">{{ $amenity }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Property Details -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Property Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="py-3 border-b border-gray-200">
                        <p class="text-sm text-gray-500">Property ID</p>
                        <p class="text-sm font-medium text-gray-900">{{ $property->reference ?? 'PROP-2025-001' }}</p>
                    </div>
                    <div class="py-3 border-b border-gray-200">
                        <p class="text-sm text-gray-500">Property Type</p>
                        <p class="text-sm font-medium text-gray-900">{{ $property->type ?? 'House' }}</p>
                    </div>
                    <div class="py-3 border-b border-gray-200">
                        <p class="text-sm text-gray-500">Year Built</p>
                        <p class="text-sm font-medium text-gray-900">{{ $property->year_built ?? '2020' }}</p>
                    </div>
                    <div class="py-3 border-b border-gray-200">
                        <p class="text-sm text-gray-500">Lot Size</p>
                        <p class="text-sm font-medium text-gray-900">{{ number_format($property->lot_size ?? 5000) }} sq ft</p>
                    </div>
                    <div class="py-3 border-b border-gray-200">
                        <p class="text-sm text-gray-500">Floors</p>
                        <p class="text-sm font-medium text-gray-900">{{ $property->floors ?? 2 }}</p>
                    </div>
                    <div class="py-3 border-b border-gray-200">
                        <p class="text-sm text-gray-500">Furnishing</p>
                        <p class="text-sm font-medium text-gray-900">{{ $property->furnishing ?? 'Unfurnished' }}</p>
                    </div>
                </div>
            </div>

            <!-- Location Map -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Location</h2>
                <div class="bg-gray-200 h-64 rounded-lg flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-map-marked-alt text-gray-400 text-5xl mb-2"></i>
                        <p class="text-gray-600">Map integration here</p>
                        <p class="text-sm text-gray-500">{{ $property->latitude ?? '34.0736' }}, {{ $property->longitude ?? '-118.4004' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- Contact Agent -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Assigned Realtor</h3>
                <div class="flex items-center space-x-3 mb-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($property->realtor_name ?? 'Agent') }}" class="h-12 w-12 rounded-full" alt="">
                    <div>
                        <p class="font-medium text-gray-900">{{ $property->realtor_name ?? 'Sarah Johnson' }}</p>
                        <p class="text-sm text-gray-500">Senior Realtor</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-phone mr-2"></i> Call Agent
                    </button>
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md">
                        <i class="fas fa-envelope mr-2"></i> Send Email
                    </button>
                </div>
            </div>

            <!-- Interested Clients -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-900">Interested Clients</h3>
                    <span class="text-xs text-gray-500">{{ $interested_count ?? 12 }}</span>
                </div>
                <div class="p-4 space-y-3">
                    @foreach($interested_clients ?? [] as $client)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer">
                            <div class="flex items-center space-x-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($client->name ?? 'Client') }}" class="h-8 w-8 rounded-full" alt="">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $client->name ?? 'John Doe' }}</p>
                                    <p class="text-xs text-gray-500">{{ $client->date ?? '2 days ago' }}</p>
                                </div>
                            </div>
                            <button class="text-indigo-600 hover:text-indigo-700">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <div class="px-6 py-3 border-t border-gray-200">
                    <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>

            <!-- Viewing Schedule -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Upcoming Viewings</h3>
                <div class="space-y-3">
                    @foreach($viewings ?? [] as $viewing)
                        <div class="border-l-4 border-indigo-600 bg-indigo-50 p-3 rounded">
                            <p class="text-sm font-medium text-gray-900">{{ $viewing->client ?? 'Michael Brown' }}</p>
                            <p class="text-xs text-gray-600 mt-1">
                                <i class="fas fa-calendar mr-1"></i> {{ $viewing->date ?? 'Nov 18, 2025' }}
                            </p>
                            <p class="text-xs text-gray-600">
                                <i class="fas fa-clock mr-1"></i> {{ $viewing->time ?? '2:00 PM' }}
                            </p>
                        </div>
                    @endforeach
                </div>
                <button class="mt-4 w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm">
                    <i class="fas fa-plus mr-2"></i> Schedule Viewing
                </button>
            </div>

            <!-- Performance Stats -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Performance</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Views</span>
                            <span class="font-medium text-gray-900">{{ $property->views ?? 234 }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Inquiries</span>
                            <span class="font-medium text-gray-900">{{ $property->inquiries ?? 18 }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: 45%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Viewings</span>
                            <span class="font-medium text-gray-900">{{ $property->viewings_count ?? 12 }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 30%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm text-left">
                        <i class="fas fa-star mr-2 text-yellow-500"></i> Mark as Featured
                    </button>
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm text-left">
                        <i class="fas fa-copy mr-2 text-blue-500"></i> Duplicate Property
                    </button>
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm text-left">
                        <i class="fas fa-eye-slash mr-2 text-gray-500"></i> Mark as Draft
                    </button>
                    <button class="w-full bg-white border border-red-300 hover:bg-red-50 text-red-700 px-4 py-2 rounded-md text-sm text-left">
                        <i class="fas fa-archive mr-2"></i> Archive Property
                    </button>
                </div>
            </div>

            <!-- Similar Properties -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-900">Similar Properties</h3>
                </div>
                <div class="p-4 space-y-3">
                    @foreach($similar_properties ?? [] as $similar)
                        <div class="border border-gray-200 rounded-lg overflow-hidden hover:border-indigo-300 cursor-pointer transition">
                            <img src="{{ $similar->image ?? 'https://via.placeholder.com/300x150' }}" class="w-full h-24 object-cover" alt="">
                            <div class="p-3">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $similar->title ?? '3 Bedroom Condo' }}</p>
                                <p class="text-xs text-gray-500">{{ $similar->location ?? 'Los Angeles, CA' }}</p>
                                <p class="text-sm font-bold text-indigo-600 mt-1">${{ number_format($similar->price ?? 380000, 0) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
