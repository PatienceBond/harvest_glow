@props([
    'name' => '',
    'title' => '',
    'bio' => '',
    'image' => null,
    'isLeadership' => false,
    'linkedinUrl' => null
])

<div 
    x-data="{ showBio: false }"
    class="rounded-lg overflow-hidden group transition-all duration-300 relative"
    {{ $attributes }}
>
    <!-- Profile Image Container -->
    <div class="relative overflow-hidden">
        @if($image)
            <img 
                src="{{ $image }}" 
                alt="{{ $name }}" 
                class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105"
                @click="!$event.target.closest('button') && (showBio = !showBio)"
            >
        @else
            <div 
                class="w-full h-64 bg-primary/10 flex items-center justify-center"
                @click="!$event.target.closest('button') && (showBio = !showBio)"
            >
                <x-heroicon-o-user class="w-24 h-24 text-primary" />
            </div>
        @endif
        
        <!-- Bio Overlay (Desktop & Mobile) -->
        <div 
            x-show="showBio"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 bg-black/80 p-4 overflow-y-auto custom-scrollbar z-10"
            @click.away="showBio = false"
        >
            <button 
                @click.stop="showBio = false"
                class="absolute top-2 right-2 text-white hover:text-primary transition-colors z-20"
                aria-label="Close bio"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            @if($bio)
                <p class="text-sm text-white leading-relaxed mt-4">{{ $bio }}</p>
            @else
                <p class="text-white/70 italic">No bio available</p>
            @endif
        </div>
        
        <!-- Hover Overlay (Desktop Only) -->
        <div 
            x-show="!showBio"
            class="hidden md:block absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
        ></div>
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
            
            <div class="flex items-center space-x-2">
                <!-- Bio Toggle Button -->
                <button 
                    @click.stop="showBio = !showBio" 
                    class="flex items-center justify-center text-white bg-primary hover:bg-primary/90 transition-colors duration-200 rounded-full p-1.5"
                    :title="showBio ? 'Hide Bio' : 'View Bio'"
                    :class="{ 'bg-primary/80': showBio }"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span class="sr-only">View Bio</span>
                </button>
                
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
</div>
