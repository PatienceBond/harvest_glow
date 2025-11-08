@props([
    'name' => '',
    'title' => '',
    'bio' => '',
    'image' => null,
    'isLeadership' => false,
    'linkedinUrl' => null
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
            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/90 to-transparent">
                <div class="text-center text-white">
                    <h3 class="text-xl font-bold mb-1">{{ $name }}</h3>
                    <p class="text-primary font-medium">{{ $title }}</p>
                    @if($bio)
                        <p class="text-sm leading-relaxed mt-2 line-clamp-3">{{ $bio }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Card Footer -->
    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div class="text-center flex-1">
                <h3 class="text-lg font-bold">{{ $name }}</h3>
                <p class="text-primary font-medium text-sm">{{ $title }}</p>
                @if($isLeadership)
                    <span class="inline-block mt-1 px-2 py-0.5 bg-primary/10 text-primary text-xs font-medium rounded-full">
                        Leadership
                    </span>
                @endif
            </div>
            
            @if($linkedinUrl)
                <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-[#0A66C2] transition-colors duration-200" title="View on LinkedIn">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">View {{ $name }} on LinkedIn</span>
                </a>
            @endif
        </div>
    </div>
</div>
