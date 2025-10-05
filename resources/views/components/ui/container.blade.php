@props(['size' => 'lg'])

@php
$sizes = [
    'sm' => 'max-w-3xl',
    'md' => 'max-w-5xl',
    'lg' => 'max-w-6xl',
    'xl' => 'max-w-7xl',
    '7xl' => 'max-w-7xl',
    'full' => 'max-w-full',
];

$sizeClass = $sizes[$size] ?? $sizes['7xl'];
@endphp

<div {{ $attributes->merge(['class' => "$sizeClass mx-auto  p-4"]) }}>
    {{ $slot }}
</div>
