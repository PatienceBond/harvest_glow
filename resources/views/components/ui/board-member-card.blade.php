@props([
    'name' => '',
    'title' => '',
    'role' => '',
    'image' => null
])

<div {{ $attributes->merge(['class' => 'rounded-lg overflow-hidden group cursor-pointer transition-all duration-300']) }}>
    <!-- Profile Image Container -->
    <div class="relative overflow-hidden">
        @if($image)
            <img src="{{ $image }}" alt="{{ $name }}" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
        @else
            <div class="w-full h-48 bg-primary/10 flex items-center justify-center">
                <x-heroicon-o-user class="w-16 h-16 text-primary" />
            </div>
        @endif
        
        <!-- Overlay with role on hover -->
        <div class="absolute inset-0 bg-black/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4">
            <div class="text-center text-white">
                <h3 class="text-lg font-bold mb-2">{{ $name }}</h3>
                @if($role)
                    <p class="text-primary font-medium">{{ $role }}</p>
                @endif
                @if($title)
                    <p class="text-sm text-gray-300 mt-1">{{ $title }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Card Content -->
    <div class="p-4 text-center">
        <!-- Name and Role -->
        <div>
            <h3 class="text-base font-bold">{{ $name }}</h3>
            @if($role)
                <p class="text-primary font-medium text-sm">{{ $role }}</p>
            @endif
            @if($title)
                <p class="text-muted-foreground text-xs">{{ $title }}</p>
            @endif
        </div>

        
    </div>
</div>
