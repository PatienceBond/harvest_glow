@props([
    'name' => '',
    'description' => '',
    'website' => '',
    'logo' => null,
    'category' => ''
])

<div {{ $attributes->merge(['class' => 'bg-card border border-border rounded-lg p-6 group hover:shadow-lg transition-all duration-300']) }}>
    <div class="space-y-4">
        <!-- Logo -->
        <div class="flex justify-center">
            @if($logo)
                <img src="{{ $logo }}" alt="{{ $name }}" class="h-16 w-auto object-contain">
            @else
                <div class="h-16 w-32 bg-primary/10 rounded flex items-center justify-center">
                    <span class="text-primary font-bold text-lg">{{ $name }}</span>
                </div>
            @endif
        </div>

        <!-- Partner Info -->
        <div class="text-center space-y-3">
            <h3 class="text-xl font-bold">{{ $name }}</h3>
            @if($category)
                <span class="inline-block px-3 py-1 bg-primary/10 text-primary text-sm font-medium rounded-full">
                    {{ $category }}
                </span>
            @endif
            <p class="text-muted-foreground text-sm leading-relaxed">{{ $description }}</p>
            
            @if($website)
                <a href="{{ $website }}" target="_blank" rel="noopener noreferrer" 
                   class="inline-flex items-center gap-2 text-primary hover:text-primary/80 font-medium text-sm transition-colors">
                    Visit Website
                    <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4" />
                </a>
            @endif
        </div>
    </div>
</div>
