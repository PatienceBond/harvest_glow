@props([
    'name' => '',
    'title' => '',
    'bio' => '',
    'image' => null,
    'isLeadership' => false
])

<div {{ $attributes->merge(['class' => 'rounded-lg overflow-hidden group cursor-pointer transition-all duration-300']) }}>
    <!-- Profile Image Container -->
    <div class="relative overflow-hidden">
        @if($image)
            <img src="{{ $image }}" alt="{{ $name }}" class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105">
        @else
            <div class="w-full h-64 bg-primary/10 flex items-center justify-center">
                <x-heroicon-o-user class="w-24 h-24 text-primary" />
            </div>
        @endif
        
        <!-- Overlay with description on hover -->
        <div class="absolute inset-0 bg-black/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4">
            <div class="text-center text-white">
                <h3 class="text-xl font-bold mb-2">{{ $name }}</h3>
                <p class="text-primary font-medium mb-3">{{ $title }}</p>
                @if($bio)
                    <p class="text-sm leading-relaxed">{{ Str::limit($bio, 150) }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Card Content -->
    <div class="p-4">
        <!-- Name and Title -->
        <div class="text-center">
            <h3 class="text-lg font-bold">{{ $name }}</h3>
            <p class="text-primary font-medium text-sm">{{ $title }}</p>
            @if($isLeadership)
                <span class="inline-block mt-2 px-3 py-1 bg-primary/10 text-primary text-xs font-medium rounded-full">
                    Leadership Team
                </span>
            @endif
        </div>

        
    </div>
</div>
