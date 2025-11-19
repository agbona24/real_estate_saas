<form id="slide-panel-form" class="space-y-6" @submit.prevent="
    $dispatch('show-toast', { message: 'Lead created successfully!', type: 'success' });
    $dispatch('close-slide-panel');
">
    <!-- Lead Name -->
    <div>
        <label for="lead_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Full Name <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            id="lead_name"
            name="lead_name"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="E.g., John Doe"
        />
    </div>

    <!-- Email & Phone -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="lead_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Email <span class="text-red-500">*</span>
            </label>
            <input
                type="email"
                id="lead_email"
                name="lead_email"
                required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                placeholder="john@example.com"
            />
        </div>
        <div>
            <label for="lead_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Phone <span class="text-red-500">*</span>
            </label>
            <input
                type="tel"
                id="lead_phone"
                name="lead_phone"
                required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                placeholder="+234 xxx xxx xxxx"
            />
        </div>
    </div>

    <!-- Lead Source -->
    <div>
        <label for="lead_source" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Lead Source <span class="text-red-500">*</span>
        </label>
        <select
            id="lead_source"
            name="lead_source"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        >
            <option value="">Select source</option>
            <option value="website">Website</option>
            <option value="referral">Referral</option>
            <option value="social_media">Social Media</option>
            <option value="walk_in">Walk-in</option>
            <option value="phone_call">Phone Call</option>
            <option value="event">Event</option>
            <option value="other">Other</option>
        </select>
    </div>

    <!-- Interest/Property Type -->
    <div>
        <label for="interest" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Property Interest
        </label>
        <input
            type="text"
            id="interest"
            name="interest"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="E.g., 3-bedroom apartment in Lekki"
        />
    </div>

    <!-- Budget Range -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="budget_min" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Min Budget (₦)
            </label>
            <input
                type="number"
                id="budget_min"
                name="budget_min"
                min="0"
                step="1000000"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                placeholder="0"
            />
        </div>
        <div>
            <label for="budget_max" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Max Budget (₦)
            </label>
            <input
                type="number"
                id="budget_max"
                name="budget_max"
                min="0"
                step="1000000"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                placeholder="0"
            />
        </div>
    </div>

    <!-- Assign To -->
    <div>
        <label for="assign_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Assign To
        </label>
        <select
            id="assign_to"
            name="assign_to"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        >
            <option value="">Unassigned</option>
            <option value="1">John Adeleke</option>
            <option value="2">Aisha Okonkwo</option>
            <option value="3">Tunde Bello</option>
        </select>
    </div>

    <!-- Status -->
    <div>
        <label for="lead_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Status
        </label>
        <select
            id="lead_status"
            name="lead_status"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        >
            <option value="new">New</option>
            <option value="contacted">Contacted</option>
            <option value="qualified">Qualified</option>
            <option value="negotiation">Negotiation</option>
        </select>
    </div>

    <!-- Notes -->
    <div>
        <label for="lead_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Notes
        </label>
        <textarea
            id="lead_notes"
            name="lead_notes"
            rows="4"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="Additional notes about the lead..."
        ></textarea>
    </div>
</form>
