<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      class="h-full {{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
<head>
    @include('partials.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
</head>
<body class="h-full antialiased bg-background text-foreground">
    <div class="min-h-screen flex items-center justify-center bg-muted/30 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo Section -->
            <div class="text-center">
                <a href="{{ route('home') }}" class="flex justify-center">
                    <img src="{{ asset('logo/logo_vertical.png') }}" alt="HarvestGlow" class="h-16 w-auto">
                </a>
                @if(isset($title))
                <h2 class="mt-2 text-3xl font-bold text-foreground">
                    {{ $title }}
                </h2>
                @endif
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
            <div class="text-center">
                <p class="text-sm text-muted-foreground">
                    <a href="{{ route('home') }}" class="font-medium text-primary hover:text-primary/80 transition-colors">
                        ← Back to Home
                    </a>
                </p>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
