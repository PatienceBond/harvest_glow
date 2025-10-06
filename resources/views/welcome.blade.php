<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
<head>
    @include('partials.head')
    @livewireStyles
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-sans">
    <livewire:navigation />
    
    <main>
        <livewire:homepage />
    </main>
    
    <livewire:footer />
    
    @livewireScripts
</body>
</html>

