@extends('layouts.app')

@section('title', 'Add New Property')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">
            <i class="fas fa-home mr-2 text-indigo-600"></i>
            Add New Property
        </h1>
        <p class="mt-1 text-sm text-gray-600">
            Create a new property listing with all details and media
        </p>
    </div>

    <form action="{{ route('tenant.properties.store') }}" method="POST" enctype="multipart/form-data" x-data="{ type: 'sale', category: '' }">
        @csrf

        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-gray-600"></i>
                    Basic Information
                </h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Property Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Property Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="e.g., Luxury 4 Bedroom Villa with Pool">
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Property Category <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id" id="category_id" x-model="category" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select Category</option>
                            <option value="1">Land</option>
                            <option value="2">Houses</option>
                            <option value="3">Apartments</option>
                            <option value="4">Commercial</option>
                            <option value="5">Shortlet</option>
                            <option value="6">Estates</option>
                        </select>
                    </div>

                    <!-- Listing Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                            Listing Type <span class="text-red-500">*</span>
                        </label>
                        <select name="type" id="type" x-model="type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="sale">For Sale</option>
                            <option value="rent">For Rent</option>
                            <option value="lease">For Lease</option>
                            <option value="shortlet">Shortlet</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                            Price (USD) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="price" id="price" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="450000">
                    </div>

                    <!-- Price Period (for rent/lease) -->
                    <div x-show="type !== 'sale'">
                        <label for="price_period" class="block text-sm font-medium text-gray-700 mb-1">
                            Price Period
                        </label>
                        <select name="price_period" id="price_period"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="month">Per Month</option>
                            <option value="year">Per Year</option>
                            <option value="night">Per Night</option>
                            <option value="week">Per Week</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="4" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Describe the property in detail..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-map-marker-alt mr-2 text-gray-600"></i>
                    Location
                </h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                            Street Address <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="address" id="address" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="123 Main Street">
                    </div>

                    <!-- City -->
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                            City <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="city" id="city" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Los Angeles">
                    </div>

                    <!-- State -->
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-1">
                            State/Province <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="state" id="state" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="California">
                    </div>

                    <!-- Country -->
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">
                            Country <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="country" id="country" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="United States">
                    </div>

                    <!-- Zip Code -->
                    <div>
                        <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-1">
                            Zip/Postal Code
                        </label>
                        <input type="text" name="zip_code" id="zip_code"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="90210">
                    </div>

                    <!-- GPS Coordinates -->
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">
                            Latitude
                        </label>
                        <input type="text" name="latitude" id="latitude"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="34.0522">
                    </div>

                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">
                            Longitude
                        </label>
                        <input type="text" name="longitude" id="longitude"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="-118.2437">
                    </div>
                </div>
            </div>
        </div>

        <!-- Property Details -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-ruler-combined mr-2 text-gray-600"></i>
                    Property Details
                </h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Bedrooms -->
                    <div>
                        <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-1">
                            Bedrooms
                        </label>
                        <input type="number" name="bedrooms" id="bedrooms"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="4">
                    </div>

                    <!-- Bathrooms -->
                    <div>
                        <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-1">
                            Bathrooms
                        </label>
                        <input type="number" name="bathrooms" id="bathrooms"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="3">
                    </div>

                    <!-- Area -->
                    <div>
                        <label for="area" class="block text-sm font-medium text-gray-700 mb-1">
                            Area (sqft)
                        </label>
                        <input type="number" name="area" id="area"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="2500">
                    </div>

                    <!-- Year Built -->
                    <div>
                        <label for="year_built" class="block text-sm font-medium text-gray-700 mb-1">
                            Year Built
                        </label>
                        <input type="number" name="year_built" id="year_built"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="2020">
                    </div>
                </div>

                <!-- Amenities -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Amenities & Features
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="amenities[]" value="swimming_pool" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <span class="text-sm text-gray-700">Swimming Pool</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="amenities[]" value="gym" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <span class="text-sm text-gray-700">Gym</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="amenities[]" value="parking" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <span class="text-sm text-gray-700">Parking</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="amenities[]" value="garden" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <span class="text-sm text-gray-700">Garden</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="amenities[]" value="security" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <span class="text-sm text-gray-700">24/7 Security</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="amenities[]" value="ac" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <span class="text-sm text-gray-700">Air Conditioning</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="amenities[]" value="balcony" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <span class="text-sm text-gray-700">Balcony</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="amenities[]" value="elevator" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <span class="text-sm text-gray-700">Elevator</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Media Upload -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-images mr-2 text-gray-600"></i>
                    Property Images
                </h2>
            </div>
            <div class="p-6">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-indigo-500 transition cursor-pointer">
                    <input type="file" name="images[]" id="images" multiple accept="image/*" class="hidden">
                    <label for="images" class="cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-5xl mb-4"></i>
                        <p class="text-gray-600 font-medium mb-2">Click to upload images</p>
                        <p class="text-gray-400 text-sm">or drag and drop</p>
                        <p class="text-gray-400 text-xs mt-2">PNG, JPG, JPEG up to 10MB each</p>
                    </label>
                </div>
                <p class="text-xs text-gray-500 mt-2">Upload multiple images. First image will be the featured image.</p>
            </div>
        </div>

        <!-- Publishing Options -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-cog mr-2 text-gray-600"></i>
                    Publishing Options
                </h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status
                        </label>
                        <select name="status" id="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="draft">Draft</option>
                            <option value="available">Available</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>

                    <!-- Featured -->
                    <div class="flex items-center space-x-2 pt-6">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_featured" class="text-sm font-medium text-gray-700">
                            Mark as Featured Property
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="bg-white rounded-lg shadow px-6 py-4 flex justify-between items-center">
            <a href="{{ route('tenant.properties.index') }}" class="text-gray-600 hover:text-gray-800 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Properties
            </a>
            <div class="flex space-x-3">
                <button type="button" onclick="window.location.href='{{ route('tenant.properties.index') }}'"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Cancel
                </button>
                <button type="submit" name="action" value="draft"
                        class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Save as Draft
                </button>
                <button type="submit" name="action" value="publish"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md flex items-center">
                    <i class="fas fa-check mr-2"></i>
                    Publish Property
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Image preview functionality
document.getElementById('images').addEventListener('change', function(e) {
    // Add image preview logic here
    console.log('Images selected:', e.target.files.length);
});
</script>
@endpush
@endsection
