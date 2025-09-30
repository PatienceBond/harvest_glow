<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<footer class="bg-gray-900 dark:bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-yellow-500 rounded-full flex items-center justify-center">
                        <x-heroicon-o-sparkles class="w-5 h-5 text-white" />
                    </div>
                    <span class="text-xl font-bold">HarvestGlow</span>
                </div>
                <p class="text-gray-300 mb-4">
                    Empowering farmers, Growing futures. We're transforming agriculture through sustainable practices, 
                    innovative technology, and community-driven solutions.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <x-heroicon-o-globe-alt class="w-6 h-6" />
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <x-heroicon-o-chat-bubble-left-right class="w-6 h-6" />
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <x-heroicon-o-link class="w-6 h-6" />
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <x-heroicon-o-camera class="w-6 h-6" />
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="/about" class="text-gray-300 hover:text-white transition-colors">About Us</a></li>
                    <li><a href="/programs" class="text-gray-300 hover:text-white transition-colors">Programs</a></li>
                    <li><a href="/impact" class="text-gray-300 hover:text-white transition-colors">Impact</a></li>
                    <li><a href="/news" class="text-gray-300 hover:text-white transition-colors">News</a></li>
                    <li><a href="/contact" class="text-gray-300 hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Contact</h3>
                <div class="space-y-2 text-gray-300">
                    <div class="flex items-center space-x-2">
                        <x-heroicon-o-envelope class="w-5 h-5" />
                        <span>info@harvestglow.org</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <x-heroicon-o-phone class="w-5 h-5" />
                        <span>+1 (555) 123-4567</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <x-heroicon-o-map-pin class="w-5 h-5" />
                        <span>123 Farm Street, Agriculture City</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} HarvestGlow. All rights reserved.</p>
        </div>
    </div>
</footer>
