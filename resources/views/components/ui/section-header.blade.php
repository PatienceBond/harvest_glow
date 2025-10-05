@props([
    'title' => '',
    'description' => '',
    'align' => 'center'
])

@php
$alignments = [
    'left' => 'text-left',
    'center' => 'text-center',
    'right' => 'text-right',
];

$alignClass = $alignments[$align] ?? $alignments['center'];
$maxWidthClass = $align === 'center' ? 'max-w-3xl mx-auto' : 'max-w-3xl';
@endphp

<div {{ $attributes->merge(['class' => "$alignClass mb-12"]) }}>
    <h1 class="mb-4 text-4xl">{{ $title }}</h1>
    @if($description)
        <p class="text-lg text-muted-foreground {{ $maxWidthClass }}">
            {{ $description }}
        </p>
    @endif
</div>
