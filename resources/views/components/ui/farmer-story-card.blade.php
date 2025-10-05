@props([
    'name' => '',
    'location' => '',
    'story' => '',
    'image' => null
])

<div {{ $attributes->merge(['class' => 'bg-card border border-border rounded-lg p-6']) }}>
    <div class="space-y-4">
        <div class="flex items-center gap-4">
            @if($image)
                <img src="{{ $image }}" alt="{{ $name }}" class="w-16 h-16 rounded-full object-cover">
            @else
                <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center">
                    <x-heroicon-o-user class="w-8 h-8 text-primary" />
                </div>
            @endif
            <div>
                <h3 class="text-xl font-bold">{{ $name }}</h3>
                <p class="text-muted-foreground">{{ $location }}</p>
            </div>
        </div>
        
        <blockquote class="text-lg italic text-muted-foreground">
            "{{ $story }}"
        </blockquote>
    </div>
</div>
