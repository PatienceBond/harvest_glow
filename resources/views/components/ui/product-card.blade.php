@props([
    'title' => '',
    'description' => '',
    'image' => ''
])

<div {{ $attributes->merge(['class' => 'bg-card border border-border rounded-lg overflow-hidden hover:shadow-lg transition-shadow']) }}>
    <!-- Product Image -->
    <!-- <div class="aspect-video overflow-hidden">
        <img src="{{ $image }}"
             alt="{{ $title }}"
             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
    </div> -->

    <!-- Product Content -->
    <div class="p-6">
        <h3 class="text-xl font-bold mb-3">{{ $title }}</h3>
        <p class="text-muted-foreground">{{ $description }}</p>
    </div>
</div>
