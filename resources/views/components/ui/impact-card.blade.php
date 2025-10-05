@props([
    'value' => '',
    'description' => ''
])

<div {{ $attributes->merge(['class' => 'flex-shrink-0 bg-card border border-border rounded-lg p-6 w-80']) }}>
    <div class="space-y-3">
        <div class="text-2xl font-bold text-primary">{{ $value }}</div>
        <p class="text-muted-foreground">{{ $description }}</p>
    </div>
</div>
