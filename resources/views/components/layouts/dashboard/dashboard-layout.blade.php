<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      class="h-full {{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
<head>
    @include('partials.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <!-- Sidebar (Left Side) -->
    <flux:sidebar sticky collapsible="mobile" class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.header>
            <flux:sidebar.brand
                href="{{ route('dashboard') }}"
                logo="{{ asset('logo/logo_icon.png') }}"
                name="HarvestGlow"
            />

            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.item icon="home" href="{{ route('dashboard') }}" :current="request()->routeIs('dashboard')">Dashboard</flux:sidebar.item>
            <flux:sidebar.item icon="document-text" href="{{ route('dashboard.posts.index') }}" :current="request()->routeIs('dashboard.posts.*')">Posts</flux:sidebar.item>
            <flux:sidebar.item icon="tag" href="{{ route('dashboard.categories.index') }}" :current="request()->routeIs('dashboard.categories.*')">Categories</flux:sidebar.item>
            <flux:sidebar.item icon="chart-bar" href="{{ route('dashboard.metrics.index') }}" :current="request()->routeIs('dashboard.metrics.*')">Impact Metrics</flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:sidebar.spacer />

        <flux:sidebar.nav>
            <flux:sidebar.item icon="cog-6-tooth" href="{{ route('profile.edit') }}">Settings</flux:sidebar.item>
            <flux:sidebar.item icon="arrow-left-start-on-rectangle" href="{{ route('home') }}">Back to Site</flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:sidebar.profile name="{{ auth()->user()->initials() }}" />

            <flux:menu>
                <flux:menu.item disabled>
                    <div class="font-semibold">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-zinc-500">{{ auth()->user()->email }}</div>
                </flux:menu.item>

                <flux:menu.separator />

                <flux:menu.item icon="cog-6-tooth" href="{{ route('profile.edit') }}">Settings</flux:menu.item>
                
                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <flux:menu.item icon="arrow-right-start-on-rectangle" type="submit">Logout</flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Header (Top) -->
    <flux:header class="block! bg-white lg:bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:navbar class="w-full">
            <!-- Mobile Sidebar Toggle -->
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <!-- Theme Toggle -->
            <flux:button 
                x-data 
                x-on:click="$flux.dark = ! $flux.dark" 
                icon="moon" 
                variant="subtle" 
                size="sm"
                aria-label="Toggle dark mode"
                class="mr-2"
            />

            <!-- User Avatar Dropdown -->
            <flux:dropdown position="top" align="start">
                <flux:profile name="{{ auth()->user()->initials() }}" />

                <flux:menu>
                    <flux:menu.item disabled>
                        <div class="font-semibold">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-zinc-500">{{ auth()->user()->email }}</div>
                    </flux:menu.item>

                    <flux:menu.separator />

                    <flux:menu.item icon="cog-6-tooth" href="{{ route('profile.edit') }}">Settings</flux:menu.item>
                    <flux:menu.item icon="arrow-left" href="{{ route('home') }}">Back to Site</flux:menu.item>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <flux:menu.item icon="arrow-right-start-on-rectangle" type="submit">Logout</flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:navbar>
    </flux:header>

    <!-- Main Content -->
    <flux:main>
                        {{ $slot }}
    </flux:main>

    <!-- Toast Container -->
    <x-ui.toast-container />

    @livewireScripts
    @fluxScripts
</body>
</html>