@props([
    'value' => '',
    'label' => '',
    'align' => 'center'
])

@php
$alignments = [
    'left' => 'text-left',
    'center' => 'text-center',
    'right' => 'text-right',
];

$alignClass = $alignments[$align] ?? $alignments['left'];
@endphp

<div {{ $attributes->merge(['class' => $alignClass]) }}>
    <div class="text-3xl font-bold mb-1 text-primary">{{ $value }}</div>
    <div class="text-sm text-muted-foreground">{{ $label }}</div>
</div>
