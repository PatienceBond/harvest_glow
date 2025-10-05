@props(['spacing' => '6'])

@php
$spacings = [
    '0' => 'space-y-0',
    '1' => 'space-y-1',
    '2' => 'space-y-2',
    '3' => 'space-y-3',
    '4' => 'space-y-4',
    '5' => 'space-y-5',
    '6' => 'space-y-6',
    '8' => 'space-y-8',
    '10' => 'space-y-10',
    '12' => 'space-y-12',
    '16' => 'space-y-16',
    '20' => 'space-y-20',
];

$spacingClass = $spacings[$spacing] ?? $spacings['6'];
@endphp

<div {{ $attributes->merge(['class' => "flex flex-col $spacingClass"]) }}>
    {{ $slot }}
</div>
