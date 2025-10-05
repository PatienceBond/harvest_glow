@props([
    'value' => '',
    'title' => '',
    'description' => '',
    'icon' => null
])

<div {{ $attributes->merge(['class' => 'bg-card border border-border rounded-lg p-6 text-center']) }}>
    <div class="space-y-4">
        @if($icon)
            <div class="flex justify-center">
                <x-dynamic-component :component="$icon" class="w-12 h-12 text-primary" />
            </div>
        @endif
        <div class="text-4xl font-bold text-primary">{{ $value }}</div>
        <h3 class="text-xl font-semibold">{{ $title }}</h3>
        <p class="text-muted-foreground">{{ $description }}</p>
    </div>
</div>
