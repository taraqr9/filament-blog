<!-- Toast Notification -->
<div id="toast-container" class="fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6 pointer-events-none z-50">
    <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
        <div id="toast-message"
             class="hidden pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black/5">
            <div class="p-4">
                <div class="flex items-start">
                    <div id="toast-icon" class="shrink-0">
                        <svg class="size-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p id="toast-title" class="text-sm font-medium text-gray-900">Success!</p>
                        <p id="toast-text" class="mt-1 text-sm text-gray-500">Action completed successfully.</p>
                    </div>
                    <div class="ml-4 flex shrink-0">
                        <button id="toast-close" type="button"
                                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <span class="sr-only">Close</span>
                            <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
