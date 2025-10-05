@props([
    'title' => '',
    'description' => '',
    'icon' => ''
])

<div {{ $attributes->merge(['class' => 'text-center p-6']) }}>
    @if($icon)
        <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-4">
            <x-dynamic-component :component="$icon" class="w-8 h-8 text-primary" />
        </div>
    @endif

    <h3 class="text-xl font-bold mb-3">{{ $title }}</h3>
    <p class="text-muted-foreground">{{ $description }}</p>
</div>
