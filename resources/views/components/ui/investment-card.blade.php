@props([
    'title' => '',
    'description' => '',
    'features' => [],
    'roi' => ''
])

<div class="bg-card border border-border rounded-lg p-6">
    <h3 class="text-2xl font-bold mb-3">{{ $title }}</h3>
    <p class="text-muted-foreground mb-6">{{ $description }}</p>

    <h4 class="font-bold mb-3">Features:</h4>
    <ul class="space-y-2 mb-6">
        @foreach($features as $feature)
            <li class="flex items-start gap-2">
                <x-heroicon-o-check-circle class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" />
                <span>{{ $feature }}</span>
            </li>
        @endforeach
    </ul>

    <div class="bg-primary/10 border border-primary/20 rounded-lg p-4">
        <p class="font-semibold text-primary">{{ $roi }}</p>
    </div>
</div>
