@props([
    'image' => '',
    'heading' => '',
    'subheading' => '',
    'height' => '600px'
])

<section {{ $attributes->merge(['class' => 'relative bg-slate-900 flex items-center']) }} style="min-height: {{ $height }}">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="{{ $image }}"
             alt="{{ $heading }}"
             class="w-full h-full object-cover">
        <!-- Gradient Overlay - darker on left -->
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/50 to-black/30"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 py-32 text-left w-full">
        <x-ui.container>
        @if($subheading)
            <h1 class="tracking-wider font-normal text-left">{{ $subheading }}</h1>
        @endif

        <h1 class="text-left" >
            {{ $heading }}
        </h1>

        @if($slot->isNotEmpty())
            <div class="mt-8">
                {{ $slot }}
            </div>
        @endif
        </x-ui.container>
    </div>
</section>
