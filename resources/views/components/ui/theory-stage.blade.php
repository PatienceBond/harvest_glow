@props([
    'title' => '',
    'items' => [],
    'color' => 'primary',
    'showArrow' => true
])

@php
$colors = [
    'primary' => 'bg-primary/10 border-primary/30 text-primary',
    'secondary' => 'bg-secondary/10 border-secondary/30 text-secondary',
    'accent' => 'bg-success/10 border-success/30 text-success',
    'muted' => 'bg-muted/50 border-muted-foreground/30 text-muted-foreground',
];
$colorClass = $colors[$color] ?? $colors['primary'];
@endphp

<div class="flex-1 min-w-[250px]">
    <div class="border-2 {{ $colorClass }} rounded-lg p-6 h-full">
        <h3 class="text-xl font-bold mb-4">{{ $title }}</h3>
        <ul class="space-y-2">
            @foreach($items as $item)
                <li class="flex items-start gap-2">
                    <x-heroicon-o-check class="w-5 h-5 flex-shrink-0 mt-0.5" />
                    <span class="text-sm">{{ $item }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    @if($showArrow)
        <div class="hidden lg:flex justify-center my-4">
            <x-heroicon-o-arrow-right class="w-8 h-8 text-primary" />
        </div>
    @endif
</div>
