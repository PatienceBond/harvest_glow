@props([
    'heading' => 'Empowering Farmers, Building Futures',
    'height' => '600px'
])

<section {{ $attributes->merge(['class' => 'relative bg-base-950 flex items-center overflow-hidden']) }} style="min-height: {{ $height }}">
    <!-- Image Slider Background -->
    <div class="absolute inset-0" x-data="{
        currentSlide: 0,
        slides: [
            '{{ asset('images/landing hero/staff.webp') }}',
            '{{ asset('images/landing hero/field farm2.webp') }}',
            '{{ asset('images/landing hero/landing-farm.webp') }}',
            '{{ asset('images/landing hero/harvest farm.webp') }}'
        ],
        autoplay: null,
        init() {
            this.autoplay = setInterval(() => {
                this.nextSlide();
            }, 5000);
        },
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        },
        prevSlide() {
            this.currentSlide = this.currentSlide === 0 ? this.slides.length - 1 : this.currentSlide - 1;
        },
        goToSlide(index) {
            this.currentSlide = index;
            clearInterval(this.autoplay);
            this.autoplay = setInterval(() => {
                this.nextSlide();
            }, 5000);
        }
    }">
        <!-- Slider Images -->
        <template x-for="(slide, index) in slides" :key="index">
            <div
                x-show="currentSlide === index"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-1000"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0"
            >
                <img
                    :src="slide"
                    :alt="`{{ $heading }} - Slide ${index + 1}`"
                    class="w-full h-full object-cover"
                    loading="lazy"
                >
            </div>
        </template>

        <!-- Navigation Arrows -->
        <!-- <div class="absolute inset-0 flex items-center justify-between px-4 sm:px-8 pointer-events-none z-30">
            <button
                @click="prevSlide()"
                class="pointer-events-auto w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 flex items-center justify-center text-white transition-all duration-300 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-white/50"
                aria-label="Previous slide"
            >
                <x-heroicon-o-chevron-left class="w-6 h-6" />
            </button>
            <button
                @click="nextSlide()"
                class="pointer-events-auto w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 flex items-center justify-center text-white transition-all duration-300 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-white/50"
                aria-label="Next slide"
            >
                <x-heroicon-o-chevron-right class="w-6 h-6" />
            </button>
        </div> -->

        <!-- Slide Indicators -->
        <div class="absolute bottom-8 left-0 right-0 flex justify-center gap-2 z-30">
            <template x-for="(slide, index) in slides" :key="index">
                <button
                    @click="goToSlide(index)"
                    :class="currentSlide === index ? 'bg-white w-8' : 'bg-white/40 w-3'"
                    class="h-3 rounded-full transition-all duration-300 hover:bg-white/80 focus:outline-none focus:ring-2 focus:ring-white/50"
                    :aria-label="`Go to slide ${index + 1}`"
                ></button>
            </template>
        </div>
    </div>

    <!-- Strong Dark Overlay - OUTSIDE Alpine container -->
    <div class="absolute inset-0 bg-black/60 z-10 pointer-events-none"></div>

    <!-- Gradient Overlay - darker on left where text is -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/10 to-transparent z-10 pointer-events-none"></div>

    <!-- Content -->
    <div class="relative z-20 py-24 sm:py-32 text-left w-full">
        <x-ui.container>
            <div class="max-w-4xl">
                <!-- Main Heading with animated gradient -->
                <h1 class="text-white text-5xl sm:text-6xl  font-bold leading-tight mb-8 animate-fade-in drop-shadow-2xl">
                    {{ $heading }}
                </h1>

                @if($slot->isNotEmpty())
                    <div class="mt-8 animate-fade-in-delay text-white/90 text-xl drop-shadow-lg">
                        {{ $slot }}
                    </div>
                @endif

                <!-- Optional CTA Button -->
                <div class="mt-12 animate-fade-in-delay-2">
                    <a href="{{ route('about') }}"
                       class="inline-flex items-center justify-center gap-3 px-8 py-4 sm:px-10 sm:py-5 text-base sm:text-lg font-semibold rounded-lg bg-primary text-white hover:bg-primary/90 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 focus:ring-offset-base-950 shadow-xl whitespace-nowrap">
                        Learn Our Story
                        <x-heroicon-o-arrow-right class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" />
                    </a>
                </div>
            </div>
        </x-ui.container>
    </div>
</section>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 1s ease-out forwards;
}

.animate-fade-in-delay {
    opacity: 0;
    animation: fade-in 1s ease-out 0.3s forwards;
}

.animate-fade-in-delay-2 {
    opacity: 0;
    animation: fade-in 1s ease-out 0.6s forwards;
}
</style>
