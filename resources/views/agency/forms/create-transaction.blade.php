<form id="slide-panel-form" class="space-y-6" @submit.prevent="
    $dispatch('show-toast', { message: 'Transaction recorded successfully!', type: 'success' });
    $dispatch('close-slide-panel');
">
    <!-- Transaction ID (Auto-generated) -->
    <div>
        <label for="transaction_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Transaction ID
        </label>
        <input
            type="text"
            id="transaction_id"
            name="transaction_id"
            readonly
            value="TXN-2024-0848"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400"
        />
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Auto-generated upon submission</p>
    </div>

    <!-- Property Selection -->
    <div>
        <label for="property" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Property <span class="text-red-500">*</span>
        </label>
        <select
            id="property"
            name="property"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        >
            <option value="">Select property</option>
            <optgroup label="Available Properties">
                <option value="1">5BR Detached Duplex - Banana Island (₦450M)</option>
                <option value="2">3BR Apartment - Victoria Island (₦85M)</option>
                <option value="3">2BR Flat - Lekki Phase 1 (₦42M)</option>
                <option value="4">4BR Terrace - Ajah (₦68.5M)</option>
                <option value="5">Commercial Space - Ikeja GRA (₦225M)</option>
            </optgroup>
        </select>
    </div>

    <!-- Client Information -->
    <div>
        <label for="client" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Client <span class="text-red-500">*</span>
        </label>
        <select
            id="client"
            name="client"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        >
            <option value="">Select client</option>
            <option value="new">+ Add New Client</option>
            <optgroup label="Existing Clients">
                <option value="1">Chief Adekunle Obi</option>
                <option value="2">Mrs. Fatima Hassan</option>
                <option value="3">Mr. Chinedu Okafor</option>
                <option value="4">Dr. Oluwaseun Balogun</option>
                <option value="5">Zenith Holdings Ltd</option>
            </optgroup>
        </select>
    </div>

    <!-- Sale Amount -->
    <div>
        <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Sale Amount (₦) <span class="text-red-500">*</span>
        </label>
        <input
            type="number"
            id="amount"
            name="amount"
            required
            min="0"
            step="1000000"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            placeholder="0"
        />
    </div>

    <!-- Payment Type & Status -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="payment_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Payment Type <span class="text-red-500">*</span>
            </label>
            <select
                id="payment_type"
                name="payment_type"
                required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            >
                <option value="outright">Outright Payment</option>
                <option value="installment">Installment Plan</option>
                <option value="mortgage">Mortgage</option>
            </select>
        </div>
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
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
    </div>

    <!-- Initial Deposit -->
    <div>
        <label for="initial_deposit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Initial Deposit (₦)
        </label>
        <input
            type="number"
            id="initial_deposit"
            name="initial_deposit"
            min="0"
            step="100000"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            placeholder="0"
        />
    </div>

    <!-- Agent Assignment -->
    <div>
        <label for="agent" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Assigned Agent <span class="text-red-500">*</span>
        </label>
        <select
            id="agent"
            name="agent"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        >
            <option value="">Select agent</option>
            <option value="1">John Adeleke</option>
            <option value="2">Aisha Okonkwo</option>
            <option value="3">Tunde Bello</option>
            <option value="4">Chioma Nwankwo</option>
            <option value="5">Ibrahim Hassan</option>
        </select>
    </div>

    <!-- Commission Rate -->
    <div class="grid grid-cols-2 gap-4">
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
                value="5"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            />
        </div>
        <div>
            <label for="commission_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Commission Amount (₦)
            </label>
            <input
                type="number"
                id="commission_amount"
                name="commission_amount"
                readonly
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400"
                placeholder="Auto-calculated"
            />
        </div>
    </div>

    <!-- Transaction Date -->
    <div>
        <label for="transaction_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Transaction Date <span class="text-red-500">*</span>
        </label>
        <input
            type="date"
            id="transaction_date"
            name="transaction_date"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        />
    </div>

    <!-- Expected Closing Date -->
    <div>
        <label for="closing_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Expected Closing Date
        </label>
        <input
            type="date"
            id="closing_date"
            name="closing_date"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        />
    </div>

    <!-- Payment Method -->
    <div>
        <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Payment Method
        </label>
        <select
            id="payment_method"
            name="payment_method"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
        >
            <option value="bank_transfer">Bank Transfer</option>
            <option value="cheque">Cheque</option>
            <option value="cash">Cash</option>
            <option value="pos">POS</option>
            <option value="online">Online Payment</option>
        </select>
    </div>

    <!-- Notes -->
    <div>
        <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Transaction Notes
        </label>
        <textarea
            id="notes"
            name="notes"
            rows="4"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="Add any additional transaction details, special terms, or conditions..."
        ></textarea>
    </div>

    <!-- Document Upload -->
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Attach Documents
        </label>
        <div class="flex items-center justify-center w-full">
            <label for="documents" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-semibold">Click to upload</span> or drag and drop
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">PDF, DOC, DOCX (MAX. 10MB)</p>
                </div>
                <input id="documents" name="documents" type="file" class="hidden" multiple accept=".pdf,.doc,.docx" />
            </label>
        </div>
    </div>
</form>
