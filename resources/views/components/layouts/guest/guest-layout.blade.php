<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      class="h-full {{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HarvestGlow') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full antialiased bg-background text-foreground" x-data="{ mobileMenuOpen: false }">
    <!-- Navigation Header -->
<!-- Navigation Header -->
<header class="sticky top-0 left-0 right-0 z-50 bg-background border-b border-border">
    <x-ui.container class="py-0 sm:px-6 lg:px-0">
        <div class="flex justify-between items-center py-3">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('logo/logo.png') }}" alt="HarvestGlow" class="h-10 w-auto">
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center space-x-8 text-foreground">
                <a href="{{ route('home') }}" class="hover:text-primary transition">Home</a>
                <a href="{{ route('about') }}" class="hover:text-primary transition">About</a>
                <a href="#model" class="hover:text-primary transition">Our Model</a>
                <a href="#impact" class="hover:text-primary transition">Impact</a>
                <a href="#team" class="hover:text-primary transition">Team</a>
                <a href="#partners" class="hover:text-primary transition">Partners</a>
            </div>

            <!-- Auth Buttons (hidden on mobile) -->
            <div class="hidden md:flex items-center space-x-4">
                <livewire:theme-toggle />
                <x-ui.button-link href="#contact" variant="primary">
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

        <!-- Mobile Navigation -->
        <div class="md:hidden" x-show="mobileMenuOpen" x-transition>
            <div class="mt-2 space-y-2 bg-background border border-border rounded-lg shadow-lg p-4 text-foreground">
                <a href="{{ route('home') }}" class="block hover:text-primary transition">Home</a>
                <a href="{{ route('about') }}" class="block hover:text-primary transition">About</a>
                <a href="#model" class="block hover:text-primary transition">Our Model</a>
                <a href="#impact" class="block hover:text-primary transition">Impact</a>
                <a href="#team" class="block hover:text-primary transition">Team</a>
                <a href="#partners" class="block hover:text-primary transition">Partners</a>
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
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
