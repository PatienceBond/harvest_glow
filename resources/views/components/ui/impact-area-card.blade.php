@props([
    'title' => '',
    'description' => '',
    'icon' => null,
    'features' => []
])

<div {{ $attributes->merge(['class' => 'bg-card border border-border rounded-lg p-6']) }}>
    <div class="space-y-4">
        <div class="flex items-center gap-3">
            @if($icon)
                <x-dynamic-component :component="$icon" class="w-8 h-8 text-primary flex-shrink-0" />
            @endif
            <h3 class="text-2xl font-bold">{{ $title }}</h3>
        </div>
        
        <p class="text-lg text-muted-foreground">{{ $description }}</p>
        
        @if(!empty($features))
            <ul class="space-y-2">
                @foreach($features as $feature)
                    <li class="flex items-start gap-2">
                        <x-heroicon-o-check-circle class="w-5 h-5 text-success flex-shrink-0 mt-0.5" />
                        <span>{{ $feature }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
