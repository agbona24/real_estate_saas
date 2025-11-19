<form id="slide-panel-form" class="space-y-6" @submit.prevent="
    $dispatch('show-toast', { message: 'Task created successfully!', type: 'success' });
    $dispatch('close-slide-panel');
">
    <!-- Task Title -->
    <div>
        <label for="task_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Task Title <span class="text-red-500">*</span>
        </label>
        <input
            type="text"
            id="task_title"
            name="task_title"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="E.g., Follow up with Mr. Adeleke on Lekki property"
        />
    </div>

    <!-- Description -->
    <div>
        <label for="task_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Description
        </label>
        <textarea
            id="task_description"
            name="task_description"
            rows="3"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="Add task details..."
        ></textarea>
    </div>

    <!-- Priority & Status -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="task_priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Priority <span class="text-red-500">*</span>
            </label>
            <select
                id="task_priority"
                name="task_priority"
                required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            >
                <option value="low">Low</option>
                <option value="medium" selected>Medium</option>
                <option value="high">High</option>
                <option value="urgent">Urgent</option>
            </select>
        </div>
        <div>
            <label for="task_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Status
            </label>
            <select
                id="task_status"
                name="task_status"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            >
                <option value="todo">To Do</option>
                <option value="in_progress">In Progress</option>
                <option value="review">Review</option>
                <option value="done">Done</option>
            </select>
        </div>
    </div>

    <!-- Assign To & Due Date -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="task_assign_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Assign To <span class="text-red-500">*</span>
            </label>
            <select
                id="task_assign_to"
                name="task_assign_to"
                required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            >
                <option value="">Select assignee</option>
                <option value="1">John Adeleke</option>
                <option value="2">Aisha Okonkwo</option>
                <option value="3">Tunde Bello</option>
                <option value="4">Chioma Nwankwo</option>
                <option value="5">Ibrahim Hassan</option>
            </select>
        </div>
        <div>
            <label for="task_due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Due Date <span class="text-red-500">*</span>
            </label>
            <input
                type="date"
                id="task_due_date"
                name="task_due_date"
                required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            />
        </div>
    </div>

    <!-- Task Type & Related To -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="task_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Task Type
            </label>
            <select
                id="task_type"
                name="task_type"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            >
                <option value="follow_up">Follow-up</option>
                <option value="call">Phone Call</option>
                <option value="meeting">Meeting</option>
                <option value="site_visit">Site Visit</option>
                <option value="documentation">Documentation</option>
                <option value="negotiation">Negotiation</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div>
            <label for="task_related_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Related To
            </label>
            <select
                id="task_related_to"
                name="task_related_to"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            >
                <option value="">Not linked</option>
                <optgroup label="Leads">
                    <option value="lead_1">Adebayo Johnson</option>
                    <option value="lead_2">Fatima Ibrahim</option>
                    <option value="lead_3">Charles Okeke</option>
                </optgroup>
                <optgroup label="Clients">
                    <option value="client_1">Victoria Enterprises</option>
                    <option value="client_2">Mr. Okonkwo</option>
                    <option value="client_3">Lagos State Govt</option>
                </optgroup>
                <optgroup label="Properties">
                    <option value="property_1">4BR Duplex - Lekki</option>
                    <option value="property_2">3BR Apartment - VI</option>
                    <option value="property_3">5BR Mansion - Ikoyi</option>
                </optgroup>
            </select>
        </div>
    </div>

    <!-- Reminder -->
    <div>
        <label for="task_reminder" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Set Reminder
        </label>
        <select
            id="task_reminder"
            name="task_reminder"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        >
            <option value="">No reminder</option>
            <option value="15_min">15 minutes before</option>
            <option value="30_min">30 minutes before</option>
            <option value="1_hour">1 hour before</option>
            <option value="2_hours">2 hours before</option>
            <option value="1_day">1 day before</option>
        </select>
    </div>

    <!-- Notes -->
    <div>
        <label for="task_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Additional Notes
        </label>
        <textarea
            id="task_notes"
            name="task_notes"
            rows="3"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="Any additional notes or instructions..."
        ></textarea>
    </div>
</form>
