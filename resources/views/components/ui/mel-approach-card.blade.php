@props([
    'title' => '',
    'description' => '',
    'items' => []
])

<div {{ $attributes->merge(['class' => 'bg-card border border-border rounded-lg p-6']) }}>
    <div class="space-y-4">
        <h3 class="text-xl font-bold">{{ $title }}</h3>
        <p class="text-muted-foreground">{{ $description }}</p>
        
        @if(!empty($items))
            <ul class="space-y-2">
                @foreach($items as $item)
                    <li class="flex items-start gap-2">
                        <x-heroicon-o-arrow-right class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" />
                        <span>{{ $item }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
