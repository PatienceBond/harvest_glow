@props([
    'type' => 'success', // success, error, warning, info
    'message' => '',
    'show' => false
])

@if($show)
<div x-data="{ show: @js($show) }" 
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform translate-x-full"
     x-transition:enter-end="opacity-100 transform translate-x-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform translate-x-0"
     x-transition:leave-end="opacity-0 transform translate-x-full"
     x-init="setTimeout(() => show = false, 5000)"
     class="fixed top-4 right-4 z-50 max-w-sm w-full">
    
    <div class="bg-card border border-border rounded-lg shadow-lg p-4">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                @if($type === 'success')
                    <x-heroicon-o-check-circle class="w-6 h-6 text-green-600" />
                @elseif($type === 'error')
                    <x-heroicon-o-x-circle class="w-6 h-6 text-red-600" />
                @elseif($type === 'warning')
                    <x-heroicon-o-exclamation-triangle class="w-6 h-6 text-yellow-600" />
                @else
                    <x-heroicon-o-information-circle class="w-6 h-6 text-blue-600" />
                @endif
            </div>
            <div class="ml-3 flex-1">
                <p class="text-sm font-medium text-foreground">
                    @if($type === 'success')
                        Success!
                    @elseif($type === 'error')
                        Error!
                    @elseif($type === 'warning')
                        Warning!
                    @else
                        Info
                    @endif
                </p>
                <p class="text-sm text-muted-foreground mt-1">{{ $message }}</p>
            </div>
            <div class="ml-4 flex-shrink-0">
                <button @click="show = false" 
                        class="inline-flex text-muted-foreground hover:text-foreground focus:outline-none">
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                </button>
            </div>
        </div>
    </div>
</div>
@endif
