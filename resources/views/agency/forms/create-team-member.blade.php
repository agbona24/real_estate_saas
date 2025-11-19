<form id="slide-panel-form" class="space-y-6" @submit.prevent="
    $dispatch('show-toast', { message: 'Team member added successfully!', type: 'success' });
    $dispatch('close-slide-panel');
">
    <!-- Full Name -->
    <div>
        <label for="member_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Full Name <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            id="member_name"
            name="member_name"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="E.g., John Adeleke"
        />
    </div>

    <!-- Email & Phone -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="member_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Email <span class="text-red-500">*</span>
            </label>
            <input
                type="email"
                id="member_email"
                name="member_email"
                required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                placeholder="john@agency.com"
            />
        </div>
        <div>
            <label for="member_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Phone <span class="text-red-500">*</span>
            </label>
            <input
                type="tel"
                id="member_phone"
                name="member_phone"
                required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                placeholder="+234 xxx xxx xxxx"
            />
        </div>
    </div>

    <!-- Role -->
    <div>
        <label for="member_role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Role <span class="text-red-500">*</span>
        </label>
        <select
            id="member_role"
            name="member_role"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        >
            <option value="">Select role</option>
            <option value="senior_agent">Senior Agent</option>
            <option value="agent">Agent</option>
            <option value="junior_agent">Junior Agent</option>
            <option value="manager">Manager</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <!-- Department -->
    <div>
        <label for="department" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Department
        </label>
        <select
            id="department"
            name="department"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        >
            <option value="">Select department</option>
            <option value="sales">Sales</option>
            <option value="leasing">Leasing</option>
            <option value="property_management">Property Management</option>
            <option value="marketing">Marketing</option>
            <option value="administration">Administration</option>
        </select>
    </div>

    <!-- Commission Rate -->
    <div>
        <label for="commission_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Commission Rate (%)
        </label>
        <input
            type="number"
            id="commission_rate"
            name="commission_rate"
            min="0"
            max="100"
            step="0.5"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            placeholder="5.0"
        />
    </div>

    <!-- Employee ID -->
    <div>
        <label for="employee_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Employee ID
        </label>
        <input
            type="text"
            id="employee_id"
            name="employee_id"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="AG-001"
        />
    </div>

    <!-- Start Date -->
    <div>
        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Start Date <span class="text-red-500">*</span>
        </label>
        <input
            type="date"
            id="start_date"
            name="start_date"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        />
    </div>

    <!-- Status -->
    <div>
        <label for="member_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Status
        </label>
        <select
            id="member_status"
            name="member_status"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        >
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="on_leave">On Leave</option>
        </select>
    </div>

    <!-- Address -->
    <div>
        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Address
        </label>
        <textarea
            id="address"
            name="address"
            rows="3"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="Enter residential address..."
        ></textarea>
    </div>
</form>
