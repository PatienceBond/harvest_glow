<?php

use App\Models\Post;
use App\Models\ImpactMetric;
use Livewire\Volt\Component;

new class extends Component {
    public function with()
    {
        return [
            'featuredPosts' => Post::published()->latest()->take(3)->get(),
            'impactMetrics' => ImpactMetric::featured()->ordered()->get(),
        ];
    }
}; ?>

<div>
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-green-50 to-yellow-50 dark:from-gray-900 dark:to-gray-800 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                    Empowering farmers,
                    <span class="text-green-600 dark:text-green-400">Growing futures</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                    We're transforming agriculture through sustainable practices, innovative technology, 
                    and community-driven solutions that empower farmers and strengthen food security.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/programs" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                        Explore Programs
                    </a>
                    <a href="/impact" class="border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                        See Our Impact
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Metrics -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Our Impact</h2>
                <p class="text-lg text-gray-600 dark:text-gray-300">Transforming lives through sustainable agriculture</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($impactMetrics as $metric)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center border border-gray-200 dark:border-gray-700">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: {{ $metric->color }}20;">
                            @if($metric->icon === 'users')
                                <x-heroicon-o-users class="w-8 h-8" style="color: {{ $metric->color }}" />
                            @elseif($metric->icon === 'trending-up')
                                <x-heroicon-o-arrow-trending-up class="w-8 h-8" style="color: {{ $metric->color }}" />
                            @elseif($metric->icon === 'heart')
                                <x-heroicon-o-heart class="w-8 h-8" style="color: {{ $metric->color }}" />
                            @elseif($metric->icon === 'leaf')
                                <x-heroicon-o-sparkles class="w-8 h-8" style="color: {{ $metric->color }}" />
                            @else
                                <x-heroicon-o-star class="w-8 h-8" style="color: {{ $metric->color }}" />
                            @endif
                        </div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                            {{ $metric->value }}{{ $metric->unit }}
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $metric->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-300">{{ $metric->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
