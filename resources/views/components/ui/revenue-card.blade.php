@props([
    'title' => '',
    'description' => '',
    'icon' => ''
])

<div class="bg-card border border-border rounded-lg p-6">
    <div class="flex items-center gap-3 mb-3">
        @if($icon)
            <x-dynamic-component :component="$icon" class="w-8 h-8 text-primary" />
        @endif
        <h4 class="text-xl font-bold">{{ $title }}</h4>
    </div>
    <p class="text-muted-foreground">{{ $description }}</p>
</div>
