@props([
    'title' => '',
    'progress' => 0,
    'current' => '',
    'goal' => ''
])

<div {{ $attributes->merge(['class' => 'bg-card border border-border rounded-lg p-6']) }}>
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold">{{ $title }}</h3>
        <span class="text-2xl font-bold text-primary">{{ $progress }}%</span>
    </div>

    <!-- Progress Bar -->
    <div class="w-full bg-muted rounded-full h-3 mb-4">
        <div class="bg-primary h-3 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
    </div>

    <!-- Current and Goal -->
    <div class="flex justify-between text-sm text-muted-foreground">
        <span>Current: {{ $current }}</span>
        <span>Goal: {{ $goal }}</span>
    </div>
</div>
