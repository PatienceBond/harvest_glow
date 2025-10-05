<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2">
    <!-- Toasts will be dynamically added here -->
</div>

<script>
window.showToast = function(type, message) {
    const container = document.getElementById('toast-container');
    const toastId = 'toast-' + Date.now();
    
    const toastHtml = `
        <div id="${toastId}" 
             x-data="{ show: true }" 
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-full"
             x-init="setTimeout(() => show = false, 5000)"
             class="max-w-sm w-full">
            
            <div class="bg-card border border-border rounded-lg shadow-lg p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        ${type === 'success' ? '<x-heroicon-o-check-circle class="w-6 h-6 text-green-600" />' : 
                          type === 'error' ? '<x-heroicon-o-x-circle class="w-6 h-6 text-red-600" />' :
                          type === 'warning' ? '<x-heroicon-o-exclamation-triangle class="w-6 h-6 text-yellow-600" />' :
                          '<x-heroicon-o-information-circle class="w-6 h-6 text-blue-600" />'}
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-foreground">
                            ${type === 'success' ? 'Success!' : 
                              type === 'error' ? 'Error!' :
                              type === 'warning' ? 'Warning!' : 'Info'}
                        </p>
                        <p class="text-sm text-muted-foreground mt-1">${message}</p>
                    </div>
                    <div class="ml-4 flex-shrink-0">
                        <button onclick="document.getElementById('${toastId}').remove()" 
                                class="inline-flex text-muted-foreground hover:text-foreground focus:outline-none">
                            <x-heroicon-o-x-mark class="w-5 h-5" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', toastHtml);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.remove();
        }
    }, 5000);
};

// Livewire event listeners for toasts
document.addEventListener('livewire:initialized', () => {
    Livewire.on('showToast', (data) => {
        window.showToast(data.type, data.message);
    });
});
</script>
