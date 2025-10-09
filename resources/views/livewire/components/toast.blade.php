<div 
    class="fixed top-4 right-4 z-50 space-y-3"
    x-data="{ toasts: @entangle('toasts').live }"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-data="{
                show: false,
                init() {
                    setTimeout(() => this.show = true, 10);
                    setTimeout(() => {
                        this.show = false;
                        setTimeout(() => $wire.call('removeToast', toast.id), 300);
                    }, toast.duration);
                }
            }"
            x-show="show"
            x-transition:enter="transform transition ease-out duration-300"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transform transition ease-in duration-300"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="flex items-center gap-3 px-4 py-3 rounded-lg shadow-lg border max-w-sm"
            :class="{
                'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800': toast.type === 'success',
                'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800': toast.type === 'error',
                'bg-yellow-50 dark:bg-yellow-900/20 border-yellow-200 dark:border-yellow-800': toast.type === 'warning',
                'bg-blue-50 dark:bg-blue-900/20 border-blue-200 dark:border-blue-800': toast.type === 'info'
            }"
            role="alert"
        >
            <!-- Icon -->
            <div class="flex-shrink-0">
                <template x-if="toast.type === 'success'">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </template>
                <template x-if="toast.type === 'error'">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </template>
                <template x-if="toast.type === 'warning'">
                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </template>
                <template x-if="toast.type === 'info'">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </template>
            </div>

            <!-- Message -->
            <div class="flex-1 text-sm font-medium"
                :class="{
                    'text-green-800 dark:text-green-200': toast.type === 'success',
                    'text-red-800 dark:text-red-200': toast.type === 'error',
                    'text-yellow-800 dark:text-yellow-200': toast.type === 'warning',
                    'text-blue-800 dark:text-blue-200': toast.type === 'info'
                }"
                x-text="toast.message">
            </div>

            <!-- Close Button -->
            <button
                @click="show = false; setTimeout(() => $wire.call('removeToast', toast.id), 300)"
                class="flex-shrink-0 rounded-lg p-1 hover:bg-black/5 dark:hover:bg-white/10 transition-colors"
                :class="{
                    'text-green-600 dark:text-green-400': toast.type === 'success',
                    'text-red-600 dark:text-red-400': toast.type === 'error',
                    'text-yellow-600 dark:text-yellow-400': toast.type === 'warning',
                    'text-blue-600 dark:text-blue-400': toast.type === 'info'
                }"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </template>
</div>
