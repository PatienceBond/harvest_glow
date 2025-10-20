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
                <a id="nav-home-link-alt" href="/" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors pb-1 border-b-2 {{ request()->routeIs('home') ? 'border-[#E1C097]' : 'border-transparent' }}">Home</a>
                <a href="/about" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors pb-1 border-b-2 {{ request()->routeIs('about') ? 'border-[#E1C097]' : 'border-transparent' }}">About</a>
                <a href="/programs" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors pb-1 border-b-2 border-transparent">Programs</a>
                <a href="/impact" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors pb-1 border-b-2 {{ request()->routeIs('impact') ? 'border-[#E1C097]' : 'border-transparent' }}">Impact</a>
                <a id="nav-blog-link-alt" href="/#news" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors pb-1 border-b-2 border-transparent">Blog</a>
                <a href="/team" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors pb-1 border-b-2 {{ request()->routeIs('team') ? 'border-[#E1C097]' : 'border-transparent' }}">Team</a>
                <a href="/contact" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 transition-colors pb-1 border-b-2 {{ request()->routeIs('contact') ? 'border-[#E1C097]' : 'border-transparent' }}">Contact</a>
                
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
                    <a href="/#news" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400">Blog</a>
                    <a href="/team" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400">Team</a>
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
    <span id="nav-state-alt" data-home-route="{{ request()->routeIs('home') ? '1' : '0' }}" class="hidden"></span>
    <script>
        (function() {
            function updateBlogActiveAlt() {
                var blog = document.getElementById('nav-blog-link-alt');
                var home = document.getElementById('nav-home-link-alt');
                var stateEl = document.getElementById('nav-state-alt');
                var isHomeRoute = stateEl && stateEl.dataset.homeRoute === '1';
                if (!blog) return;
                var atNews = window.location.hash === '#news';
                if (atNews) {
                    blog.classList.remove('border-transparent');
                    blog.classList.add('border-\[\#E1C097\]');
                    if (home) {
                        home.classList.remove('border-\[\#E1C097\]');
                        home.classList.add('border-transparent');
                    }
                } else {
                    blog.classList.remove('border-\[\#E1C097\]');
                    blog.classList.add('border-transparent');
                    if (home && isHomeRoute) {
                        home.classList.remove('border-transparent');
                        home.classList.add('border-\[\#E1C097\]');
                    }
                }
            }
            window.addEventListener('hashchange', updateBlogActiveAlt);
            window.addEventListener('DOMContentLoaded', updateBlogActiveAlt);
        })();
    </script>
</nav>
