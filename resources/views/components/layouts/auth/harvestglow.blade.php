<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      class="h-full {{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Login' }} - {{ config('app.name', 'HarvestGlow') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full antialiased bg-background text-foreground">
    <!-- Top Loader -->
    <x-ui.top-loader color="#059669" />
    
    <div class="min-h-screen flex items-center justify-center bg-muted/30 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo Section -->
            <div class="text-center">
                <a href="{{ route('home') }}" class="flex justify-center">
                    <img src="{{ asset('logo/logo.png') }}" alt="HarvestGlow" class="h-16 w-auto">
                </a>
                <h2 class="mt-6 text-3xl font-bold text-foreground">
                    {{ $title ?? 'Welcome Back' }}
                </h2>
                @if(isset($description))
                    <p class="mt-2 text-sm text-muted-foreground">
                        {{ $description }}
                    </p>
                @endif
            </div>

            <!-- Form Section -->
            <div class="bg-card border border-border rounded-lg shadow-lg p-8">
                {{ $slot }}
            </div>

            <!-- Footer Links -->
            <div class="text-center space-y-2">
                <p class="text-sm text-muted-foreground">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="font-medium text-primary hover:text-primary/80 transition-colors">
                        Sign up here
                    </a>
                </p>
                <p class="text-sm text-muted-foreground">
                    <a href="{{ route('home') }}" class="font-medium text-primary hover:text-primary/80 transition-colors">
                        ← Back to Home
                    </a>
                </p>
            </div>
        </div>
    </div>

    @livewireScripts
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
