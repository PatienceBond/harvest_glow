<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      class="h-full {{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
<head>
    @include('partials.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
</head>
<body class="h-full antialiased bg-background text-foreground" x-data="{ mobileMenuOpen: false }">
    <!-- Navigation Header -->
<!-- Navigation Header -->
<header class="fixed top-0 left-0 right-0 z-50 bg-background border-b border-border opacity-95">
    <x-ui.container class="py-0 sm:px-6 lg:px-0">
        <div class="flex justify-between items-center py-3">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('logo/logo_vertical.png') }}" alt="HarvestGlow" class="h-7 w-auto">
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center space-x-8 text-foreground">
                <a href="{{ route('home') }}" class="hover:text-primary transition">Home</a>
                <a href="{{ route('about') }}" class="hover:text-primary transition">About</a>
                <a href="{{ route('our-model') }}" class="hover:text-primary transition">Our Model</a>
                <a href="{{ route('impact') }}" class="hover:text-primary transition">Impact</a>
                <a href="{{ route('team') }}" class="hover:text-primary transition">Team</a>
                <a href="{{ route('partners') }}" class="hover:text-primary transition">Partners</a>
                <a href="{{ route('contact') }}" class="hover:text-primary transition">Contact</a>
            </div>

            <!-- Auth Buttons (hidden on mobile) -->
            <div class="hidden md:flex items-center space-x-4">
                <livewire:theme-toggle />
                <x-ui.button-link href="{{ route('contact') }}" variant="primary">
                   Support Our Mission
                </x-ui.button-link>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <livewire:theme-toggle class="mr-2" />
                <button
                    type="button"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="text-foreground inline-flex items-center justify-center p-2 transition"
                >
                    <x-heroicon-o-bars-3 x-show="!mobileMenuOpen" class="h-6 w-6" />
                    <x-heroicon-o-x-mark x-show="mobileMenuOpen" x-cloak class="h-6 w-6" />
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div
            class="md:hidden"
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            @click.away="mobileMenuOpen = false"
            x-cloak
        >
            <div class="py-3 space-y-1 bg-card border border-border rounded-lg shadow-xl mx-4 mb-4">
                <a href="{{ route('home') }}"
                   class="block px-4 py-3 text-base font-medium text-foreground hover:bg-primary hover:text-white transition-colors rounded-md mx-2 {{ request()->routeIs('home') ? 'bg-primary/10 text-primary' : '' }}">
                    Home
                </a>
                <a href="{{ route('about') }}"
                   class="block px-4 py-3 text-base font-medium text-foreground hover:bg-primary hover:text-white transition-colors rounded-md mx-2 {{ request()->routeIs('about') ? 'bg-primary/10 text-primary' : '' }}">
                    About
                </a>
                <a href="{{ route('our-model') }}"
                   class="block px-4 py-3 text-base font-medium text-foreground hover:bg-primary hover:text-white transition-colors rounded-md mx-2 {{ request()->routeIs('our-model') ? 'bg-primary/10 text-primary' : '' }}">
                    Our Model
                </a>
                <a href="{{ route('impact') }}"
                   class="block px-4 py-3 text-base font-medium text-foreground hover:bg-primary hover:text-white transition-colors rounded-md mx-2 {{ request()->routeIs('impact') ? 'bg-primary/10 text-primary' : '' }}">
                    Impact
                </a>
                <a href="{{ route('team') }}"
                   class="block px-4 py-3 text-base font-medium text-foreground hover:bg-primary hover:text-white transition-colors rounded-md mx-2 {{ request()->routeIs('team') ? 'bg-primary/10 text-primary' : '' }}">
                    Team
                </a>
                <a href="{{ route('partners') }}"
                   class="block px-4 py-3 text-base font-medium text-foreground hover:bg-primary hover:text-white transition-colors rounded-md mx-2 {{ request()->routeIs('partners') ? 'bg-primary/10 text-primary' : '' }}">
                    Partners
                </a>
                <a href="{{ route('contact') }}"
                   class="block px-4 py-3 text-base font-medium text-foreground hover:bg-primary hover:text-white transition-colors rounded-md mx-2 {{ request()->routeIs('contact') ? 'bg-primary/10 text-primary' : '' }}">
                    Contact
                </a>

                <!-- CTA Button in Mobile Menu -->
                <div class="px-4 pt-4 pb-2 border-t border-border mt-2">
                    <a href="{{ route('contact') }}"
                       class="block w-full text-center px-4 py-3 text-base font-semibold rounded-lg bg-primary text-white hover:bg-primary/90 transition-all shadow-md">
                        Support Our Mission
                    </a>
                </div>
            </div>
        </div>
    </x-ui.container>
</header>


    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-includes.guest-footer />

    @livewireScripts
    @fluxScripts
</body>
</html>
