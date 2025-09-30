<?php

use Livewire\Volt\Component;

new class extends Component {
    public $isOpen = false;

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
    }
}; ?>

<nav class="bg-white dark:bg-gray-900 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-yellow-500 rounded-full flex items-center justify-center">
                        <x-heroicon-o-sparkles class="w-5 h-5 text-white" />
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">HarvestGlow</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors">Home</a>
                <a href="/about" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors">About</a>
                <a href="/programs" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors">Programs</a>
                <a href="/impact" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors">Impact</a>
                <a href="/news" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors">News</a>
                <a href="/contact" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors">Contact</a>
                
                <!-- Theme Toggle -->
                <livewire:theme-toggle />
                
                <!-- Auth Links -->
                @auth
                    <a href="/dashboard" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Dashboard
                    </a>
                @else
                    <a href="/login" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors">Login</a>
                    <a href="/register" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">Register</a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center space-x-2">
                <livewire:theme-toggle />
                <button 
                    wire:click="toggle"
                    class="p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800"
                >
                    <x-heroicon-o-bars-3 class="w-6 h-6" />
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        @if($isOpen)
            <div class="md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                    <a href="/" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400">Home</a>
                    <a href="/about" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400">About</a>
                    <a href="/programs" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400">Programs</a>
                    <a href="/impact" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400">Impact</a>
                    <a href="/news" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400">News</a>
                    <a href="/contact" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400">Contact</a>
                    
                    @auth
                        <a href="/dashboard" class="block px-3 py-2 bg-green-600 text-white rounded-lg">Dashboard</a>
                    @else
                        <a href="/login" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400">Login</a>
                        <a href="/register" class="block px-3 py-2 bg-green-600 text-white rounded-lg">Register</a>
                    @endauth
                </div>
            </div>
        @endif
    </div>
</nav>
