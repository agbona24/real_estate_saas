<!-- Toast Notification Container -->
<div
    x-data="{
        toasts: [],
        addToast(message, type = 'info') {
            const id = Date.now();
            this.toasts.push({ id, message, type });
            setTimeout(() => this.removeToast(id), 5000);
        },
        removeToast(id) {
            this.toasts = this.toasts.filter(toast => toast.id !== id);
        }
    }"
    @show-toast.window="addToast($event.detail.message, $event.detail.type)"
    class="fixed top-4 right-4 z-50 space-y-3 max-w-sm"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-8"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="flex items-center p-4 rounded-lg shadow-lg border backdrop-blur-sm"
            :class="{
                'bg-white/95 dark:bg-gray-800/95 border-gray-200 dark:border-gray-700': toast.type === 'info',
                'bg-success-50/95 dark:bg-success-900/95 border-success-200 dark:border-success-700': toast.type === 'success',
                'bg-warning-50/95 dark:bg-warning-900/95 border-warning-200 dark:border-warning-700': toast.type === 'warning',
                'bg-danger-50/95 dark:bg-danger-900/95 border-danger-200 dark:border-danger-700': toast.type === 'error'
            }"
        >
            <!-- Icon -->
            <div class="flex-shrink-0 mr-3">
                <!-- Success Icon -->
                <svg x-show="toast.type === 'success'" class="w-6 h-6 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>

                <!-- Error Icon -->
                <svg x-show="toast.type === 'error'" class="w-6 h-6 text-danger-600 dark:text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>

                <!-- Warning Icon -->
                <svg x-show="toast.type === 'warning'" class="w-6 h-6 text-warning-600 dark:text-warning-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>

                <!-- Info Icon -->
                <svg x-show="toast.type === 'info'" class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <!-- Message -->
            <div class="flex-1 mr-2">
                <p
                    class="text-sm font-medium"
                    :class="{
                        'text-gray-900 dark:text-white': toast.type === 'info',
                        'text-success-800 dark:text-success-200': toast.type === 'success',
                        'text-warning-800 dark:text-warning-200': toast.type === 'warning',
                        'text-danger-800 dark:text-danger-200': toast.type === 'error'
                    }"
                    x-text="toast.message"
                ></p>
            </div>

            <!-- Close Button -->
            <button
                @click="removeToast(toast.id)"
                class="flex-shrink-0 ml-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </template>
</div>
