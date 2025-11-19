<form id="slide-panel-form" class="space-y-6" @submit.prevent="
    $dispatch('show-toast', { message: 'Property created successfully!', type: 'success' });
    $dispatch('close-slide-panel');
">
    <!-- Property Title -->
    <div>
        <label for="property_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Property Title <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            id="property_title"
            name="property_title"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="E.g., Luxury 3-Bedroom Apartment in Victoria Island"
        />
    </div>

    <!-- Property Type -->
    <div>
        <label for="property_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Property Type <span class="text-red-500">*</span>
        </label>
        <select
            id="property_type"
            name="property_type"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        >
            <option value="">Select property type</option>
            <option value="land">Land</option>
            <option value="house">House</option>
            <option value="apartment">Apartment</option>
            <option value="commercial">Commercial</option>
            <option value="rental">Rental</option>
        </select>
    </div>

    <!-- Price -->
    <div>
        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Price <span class="text-red-500">*</span>
        </label>
        <div class="relative">
            <span class="absolute left-4 top-2.5 text-gray-500 dark:text-gray-400">₦</span>
            <input
                type="number"
                id="price"
                name="price"
                required
                min="0"
                step="1000"
                class="w-full pl-8 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                placeholder="0.00"
            />
        </div>
    </div>

    <!-- Location -->
    <div>
        <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Location <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            id="location"
            name="location"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="E.g., Victoria Island, Lagos"
        />
    </div>

    <!-- Bedrooms & Bathrooms -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="bedrooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Bedrooms
            </label>
            <input
                type="number"
                id="bedrooms"
                name="bedrooms"
                min="0"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                placeholder="0"
            />
        </div>
        <div>
            <label for="bathrooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Bathrooms
            </label>
            <input
                type="number"
                id="bathrooms"
                name="bathrooms"
                min="0"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                placeholder="0"
            />
        </div>
    </div>

    <!-- Area -->
    <div>
        <label for="area" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Area (sqm)
        </label>
        <input
            type="number"
            id="area"
            name="area"
            min="0"
            step="0.01"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="0.00"
        />
    </div>

    <!-- Status -->
    <div>
        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Status <span class="text-red-500">*</span>
        </label>
        <select
            id="status"
            name="status"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        >
            <option value="available">Available</option>
            <option value="reserved">Reserved</option>
            <option value="sold">Sold</option>
            <option value="off-market">Off-Market</option>
        </select>
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Description
        </label>
        <textarea
            id="description"
            name="description"
            rows="4"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="Enter property description..."
        ></textarea>
    </div>

    <!-- Features (Checkboxes) -->
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
            Features
        </label>
        <div class="grid grid-cols-2 gap-3">
            <label class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                <input type="checkbox" name="features[]" value="parking" class="rounded border-gray-300 dark:border-gray-600 text-primary-600 focus:ring-primary-500 dark:bg-gray-700">
                <span>Parking</span>
            </label>
            <label class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                <input type="checkbox" name="features[]" value="pool" class="rounded border-gray-300 dark:border-gray-600 text-primary-600 focus:ring-primary-500 dark:bg-gray-700">
                <span>Swimming Pool</span>
            </label>
            <label class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                <input type="checkbox" name="features[]" value="gym" class="rounded border-gray-300 dark:border-gray-600 text-primary-600 focus:ring-primary-500 dark:bg-gray-700">
                <span>Gym</span>
            </label>
            <label class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                <input type="checkbox" name="features[]" value="garden" class="rounded border-gray-300 dark:border-gray-600 text-primary-600 focus:ring-primary-500 dark:bg-gray-700">
                <span>Garden</span>
            </label>
            <label class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                <input type="checkbox" name="features[]" value="security" class="rounded border-gray-300 dark:border-gray-600 text-primary-600 focus:ring-primary-500 dark:bg-gray-700">
                <span>24/7 Security</span>
            </label>
            <label class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                <input type="checkbox" name="features[]" value="balcony" class="rounded border-gray-300 dark:border-gray-600 text-primary-600 focus:ring-primary-500 dark:bg-gray-700">
                <span>Balcony</span>
            </label>
        </div>
    </div>
</form>
