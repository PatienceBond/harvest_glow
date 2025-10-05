@props([
    'icon' => null,
    'title' => '',
    'content' => ''
])

<div {{ $attributes->merge(['class' => 'bg-card border border-border rounded-lg p-6']) }}>
    <div class="flex items-start gap-4">
        @if($icon)
            <div class="flex-shrink-0">
                <x-dynamic-component :component="$icon" class="w-6 h-6 text-primary" />
            </div>
        @endif
        <div class="flex-1">
            <h3 class="font-bold text-lg mb-2">{{ $title }}</h3>
            <div class="text-muted-foreground">{{ $content }}</div>
        </div>
    </div>
</div>
