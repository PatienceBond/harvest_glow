@props([
    'value' => '',
    'description' => ''
])

<div {{ $attributes->merge(['class' => 'flex-shrink-0 bg-card border border-border rounded-lg p-4']) }}>
    <div class="space-y-3">
        <div class="text-lg font-bold text-primary">{{ $value }}</div>
        <p class="text-muted-foreground text-sm">{{ $description }}</p>
    </div>
</div>
