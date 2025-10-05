@props([
    'title' => '',
    'description' => '',
    'icon' => '',
    'link' => '#'
])

<div {{ $attributes->merge(['class' => 'bg-card border border-border rounded-lg p-6 hover:shadow-lg transition-shadow']) }}>
    <div class="flex flex-col items-center text-center space-y-4">
        <!-- Icon -->
        <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center">
            @if($icon)
                <x-dynamic-component :component="$icon" class="w-8 h-8 text-primary" />
            @else
                {{ $slot->isEmpty() ? '' : $slot }}
            @endif
        </div>

        <!-- Title -->
        <h3 class="text-xl font-bold">{{ $title }}</h3>

        <!-- Description -->
        <p class="text-muted-foreground">{{ $description }}</p>

        <!-- Learn More Link -->
        <a href="{{ $link }}" class="text-primary hover:underline font-medium">
            Learn More
        </a>
    </div>
</div>
