@props([
    'href' => '#',
    'variant' => 'primary',
    'size' => 'md',
])

@php
$variants = [
    'primary' => 'bg-primary text-white hover:bg-primary/90',
    'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/80',
    'outline' => 'border-2 border-primary text-primary hover:bg-primary hover:text-white',
    'outline-white' => 'border-2 border-white text-white hover:bg-white hover:text-primary',
    'ghost' => 'text-foreground hover:bg-muted',
    'card' => 'bg-card text-foreground hover:opacity-90',
    'destructive' => 'bg-destructive text-white hover:bg-destructive/80',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-xs',
    'md' => 'px-4 py-2 text-sm',
    'lg' => 'px-6 py-3 text-base',
    'xl' => 'px-8 py-4 text-lg',
];

$baseClasses = 'inline-block font-medium rounded-lg transition-colors';
$variantClasses = $variants[$variant] ?? $variants['primary'];
$sizeClasses = $sizes[$size] ?? $sizes['md'];
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => "$baseClasses $variantClasses $sizeClasses"]) }}>
    {{ $slot }}
</a>
