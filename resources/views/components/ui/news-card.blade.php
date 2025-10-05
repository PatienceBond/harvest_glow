@props([
    'title' => '',
    'excerpt' => '',
    'date' => '',
    'image' => '',
    'link' => '#'
])

<div {{ $attributes->merge(['class' => 'bg-card border border-border rounded-lg overflow-hidden hover:shadow-lg transition-shadow']) }}>
    <!-- News Image -->
    <div class="aspect-video overflow-hidden">
        <img src="{{ $image }}"
             alt="{{ $title }}"
             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
    </div>

    <!-- News Content -->
    <div class="p-6">
        @if($date)
            <p class="text-sm text-muted-foreground mb-2">{{ $date }}</p>
        @endif
        <h3 class="text-xl font-bold mb-3">{{ $title }}</h3>
        <p class="text-muted-foreground mb-4">{{ $excerpt }}</p>
        <a href="{{ $link }}" class="text-primary font-medium hover:underline inline-flex items-center gap-2">
            Read More
            <x-heroicon-o-arrow-right class="w-4 h-4" />
        </a>
    </div>
</div>
