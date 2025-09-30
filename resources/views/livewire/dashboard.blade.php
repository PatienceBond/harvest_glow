<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\ImpactMetric;
use Livewire\Volt\Component;

new class extends Component {
    public $activeTab = 'overview';
    
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function with()
    {
        return [
            'posts' => Post::with(['user', 'category'])->latest()->take(10)->get(),
            'categories' => Category::withCount('posts')->get(),
            'metrics' => ImpactMetric::featured()->ordered()->get(),
            'totalPosts' => Post::count(),
            'publishedPosts' => Post::published()->count(),
            'draftPosts' => Post::where('is_published', false)->count(),
        ];
    }
}; ?>

<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white dark:bg-gray-800 shadow-lg min-h-screen">
            <div class="p-6">
                <div class="flex items-center space-x-2 mb-8">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-yellow-500 rounded-full flex items-center justify-center">
                        <x-heroicon-o-sparkles class="w-5 h-5 text-white" />
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">HarvestGlow</span>
                </div>
                
                <nav class="space-y-2">
                    <button 
                        wire:click="setActiveTab('overview')"
                        class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-left transition-colors {{ $activeTab === 'overview' ? 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                    >
                        <x-heroicon-o-chart-bar class="w-5 h-5" />
                        <span>Overview</span>
                    </button>
                    
                    <button 
                        wire:click="setActiveTab('posts')"
                        class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-left transition-colors {{ $activeTab === 'posts' ? 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                    >
                        <x-heroicon-o-document-text class="w-5 h-5" />
                        <span>Posts</span>
                    </button>
                    
                    <button 
                        wire:click="setActiveTab('categories')"
                        class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-left transition-colors {{ $activeTab === 'categories' ? 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                    >
                        <x-heroicon-o-tag class="w-5 h-5" />
                        <span>Categories</span>
                    </button>
                    
                    <button 
                        wire:click="setActiveTab('metrics')"
                        class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-left transition-colors {{ $activeTab === 'metrics' ? 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                    >
                        <x-heroicon-o-chart-pie class="w-5 h-5" />
                        <span>Impact Metrics</span>
                    </button>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            @if($activeTab === 'overview')
<div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Dashboard Overview</h1>
                    
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                                    <x-heroicon-o-document-text class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Posts</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalPosts }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                                    <x-heroicon-o-check-circle class="w-6 h-6 text-green-600 dark:text-green-400" />
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Published</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $publishedPosts }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                                    <x-heroicon-o-clock class="w-6 h-6 text-yellow-600 dark:text-yellow-400" />
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Drafts</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $draftPosts }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
