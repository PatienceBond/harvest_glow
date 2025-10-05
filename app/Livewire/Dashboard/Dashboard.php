<?php

namespace App\Livewire\Dashboard;

use App\Models\Post;
use App\Models\Category;
use App\Models\ImpactMetric;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard.dashboard-layout')]
class Dashboard extends Component
{
    public function render()
    {
        $totalPosts = Post::count();
        $publishedPosts = Post::published()->count();
        $totalCategories = Category::count();
        $totalMetrics = ImpactMetric::count();
        $recentPosts = Post::with('category')->latest()->limit(5)->get();

        return view('livewire.dashboard.dashboard', [
            'totalPosts' => $totalPosts,
            'publishedPosts' => $publishedPosts,
            'totalCategories' => $totalCategories,
            'totalMetrics' => $totalMetrics,
            'recentPosts' => $recentPosts,
        ]);
    }
}
