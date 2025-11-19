<!-- Slide-out Panel Component -->
<div
    x-data="{
        open: false,
        component: null,
        title: 'Form',
        init() {
            this.$watch('open', value => {
                if (value) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            });
        }
    }"
    @open-slide-panel.window="
        open = true;
        component = $event.detail.component;
        title = $event.detail.title || 'Form';
    "
    @close-slide-panel.window="open = false"
    @keydown.escape.window="open = false"
    style="display: none;"
    x-show="open"
>
    <!-- Backdrop -->
    <div
        x-show="open"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40"
        @click="open = false"
    ></div>

    <!-- Panel -->
    <div
        x-show="open"
        x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed right-0 top-0 h-full w-full md:w-2/3 lg:w-1/2 xl:w-1/3 bg-white dark:bg-gray-800 shadow-2xl z-50 flex flex-col"
    >
        <!-- Panel Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white" x-text="title"></h2>
            <button
                @click="open = false"
                class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Panel Body -->
        <div class="flex-1 overflow-y-auto p-6">
            <div x-show="component === 'create-property'">
                @include('agency.forms.create-property')
            </div>

            <div x-show="component === 'create-lead'">
                @include('agency.forms.create-lead')
            </div>

            <div x-show="component === 'create-client'">
                @include('agency.forms.create-client')
            </div>

            <!-- Default content when no component is specified -->
            <div x-show="!component">
                <p class="text-gray-500 dark:text-gray-400">Select a form to begin</p>
            </div>
        </div>

        <!-- Panel Footer -->
        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
            <button
                @click="open = false"
                type="button"
                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
            >
                Cancel
            </button>
            <button
                type="submit"
                form="slide-panel-form"
                class="px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors"
            >
                Save
            </button>
        </div>
    </div>
</div>
