<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      class="h-full {{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
<head>
    @include('partials.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
</head>
<body class="h-full antialiased bg-background text-foreground" x-data="{ sidebarOpen: false }">
    <div class="flex h-full">
        <!-- Sidebar -->
        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
            <div class="flex-1 flex flex-col min-h-0 bg-card border-r border-border">
                <!-- Logo -->
                <div class="flex items-center h-16 px-4 bg-primary/5 border-b border-border">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <img src="{{ asset('logo/logo_vertical.png') }}" alt="HarvestGlow" class="h-8 w-auto">
                        
                    </a>
                </div>
                
                <!-- Navigation -->
                <nav class="flex-1 px-2 py-4 space-y-1">
                    <a href="{{ route('dashboard') }}" 
                       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-muted hover:text-foreground' }} transition-colors">
                        <x-heroicon-o-home class="mr-3 h-5 w-5" />
                        Dashboard
                    </a>
                    
                    <a href="{{ route('dashboard.posts.index') }}" 
                       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard.posts.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-muted hover:text-foreground' }} transition-colors">
                        <x-heroicon-o-document-text class="mr-3 h-5 w-5" />
                        Posts
                    </a>
                    
                    <a href="{{ route('dashboard.categories.index') }}" 
                       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard.categories.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-muted hover:text-foreground' }} transition-colors">
                        <x-heroicon-o-tag class="mr-3 h-5 w-5" />
                        Categories
                    </a>
                    
                    <a href="{{ route('dashboard.metrics.index') }}" 
                       class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard.metrics.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-muted hover:text-foreground' }} transition-colors">
                        <x-heroicon-o-chart-bar class="mr-3 h-5 w-5" />
                        Impact Metrics
                    </a>
                </nav>
                
                <!-- User Menu -->
                <div class="flex-shrink-0 flex border-t border-border p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 bg-primary/10 rounded-full flex items-center justify-center">
                                <x-heroicon-o-user class="h-5 w-5 text-primary" />
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-foreground">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-muted-foreground">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="ml-2">
                            <livewire:theme-toggle />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 flex z-40 md:hidden"
             @click="sidebarOpen = false">
            <div class="fixed inset-0 bg-background/80" aria-hidden="true"></div>
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-card">
                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button @click="sidebarOpen = false" 
                            class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <x-heroicon-o-x-mark class="h-6 w-6 text-foreground" />
                    </button>
                </div>
                
                <!-- Mobile Logo -->
                <div class="flex items-center h-16 px-4 bg-primary/5 border-b border-border">
                    <img src="{{ asset('logo/logo.png') }}" alt="HarvestGlow" class="h-8 w-auto">
                    <span class="ml-2 text-lg font-bold text-foreground">Dashboard</span>
                </div>
                
                <!-- Mobile Navigation -->
                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <nav class="mt-5 px-2 space-y-1">
                        <a href="{{ route('dashboard') }}" 
                           class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-muted hover:text-foreground' }} transition-colors">
                            <x-heroicon-o-home class="mr-4 h-6 w-6" />
                            Dashboard
                        </a>
                        
                        <a href="{{ route('dashboard.posts.index') }}" 
                           class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('dashboard.posts.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-muted hover:text-foreground' }} transition-colors">
                            <x-heroicon-o-document-text class="mr-4 h-6 w-6" />
                            Posts
                        </a>
                        
                        <a href="{{ route('dashboard.categories.index') }}" 
                           class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('dashboard.categories.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-muted hover:text-foreground' }} transition-colors">
                            <x-heroicon-o-tag class="mr-4 h-6 w-6" />
                            Categories
                        </a>
                        
                        <a href="{{ route('dashboard.metrics.index') }}" 
                           class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ request()->routeIs('dashboard.metrics.*') ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-muted hover:text-foreground' }} transition-colors">
                            <x-heroicon-o-chart-bar class="mr-4 h-6 w-6" />
                            Impact Metrics
                        </a>
                    </nav>
                </div>
                
                <!-- Mobile User Menu -->
                <div class="flex-shrink-0 flex border-t border-border p-4">
                    <div class="flex items-center w-full">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 bg-primary/10 rounded-full flex items-center justify-center">
                                <x-heroicon-o-user class="h-5 w-5 text-primary" />
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-foreground">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-muted-foreground">{{ auth()->user()->email }}</p>
                        </div>
                        <livewire:theme-toggle />
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="md:pl-64 flex flex-col flex-1">
            <!-- Top bar -->
            <div class="sticky top-0 z-10 md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 bg-background border-b border-border">
                <button @click="sidebarOpen = true" 
                        class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-muted-foreground hover:text-foreground hover:bg-muted focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary">
                    <x-heroicon-o-bars-3 class="h-6 w-6" />
                </button>
            </div>

            <!-- Page content -->
            <main class="flex-1">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Toast Container -->
    <x-ui.toast-container />

    @livewireScripts
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
