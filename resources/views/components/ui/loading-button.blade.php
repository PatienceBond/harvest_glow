@props([
    'type' => 'submit',
    'variant' => 'primary',
    'size' => 'default',
    'loadingText' => null,
    'disabled' => false,
    'wire:target' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

    $variantClasses = [
        'primary' => 'bg-primary text-white hover:bg-primary/90 focus:ring-primary/50',
        'secondary' => 'bg-secondary text-white hover:bg-secondary/90 focus:ring-secondary/50',
        'outline' => 'border-2 border-primary text-primary hover:bg-primary hover:text-white focus:ring-primary/50',
        'ghost' => 'text-foreground hover:bg-muted focus:ring-muted',
        'destructive' => 'bg-destructive text-white hover:bg-destructive/90 focus:ring-destructive/50',
    ][$variant] ?? 'bg-primary text-white hover:bg-primary/90 focus:ring-primary/50';

    $sizeClasses = [
        'sm' => 'px-3 py-2 text-sm',
        'default' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-4 text-lg',
    ][$size] ?? 'px-4 py-2 text-sm';

    $classes = $baseClasses . ' ' . $variantClasses . ' ' . $sizeClasses;
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => $classes]) }}
    @if($disabled) disabled @endif
    x-data="{ loading: false }"
    x-on:click="if($el.form) { loading = true; setTimeout(() => loading = false, 3000); }"
    @if($attributes->has('wire:click') || $attributes->has('wire:submit'))
        wire:loading.attr="disabled"
        wire:loading.class="opacity-75 cursor-wait"
    @endif
>
    <!-- Loading Spinner -->
    <svg
        class="animate-spin -ml-1 mr-3 h-5 w-5"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        x-show="loading"
        @if($attributes->has('wire:click') || $attributes->has('wire:submit'))
            wire:loading.class.remove="hidden"
        @endif
        style="display: none;"
    >
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>

    <!-- Button Content -->
    <span
        x-show="!loading"
        @if($attributes->has('wire:click') || $attributes->has('wire:submit'))
            wire:loading.class="hidden"
        @endif
    >
        {{ $slot }}
    </span>

    <!-- Loading Text (Optional) -->
    @if($loadingText)
        <span
            x-show="loading"
            @if($attributes->has('wire:click') || $attributes->has('wire:submit'))
                wire:loading.class.remove="hidden"
            @endif
            style="display: none;"
        >
            {{ $loadingText }}
        </span>
    @endif
</button>
