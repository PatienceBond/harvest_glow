<?php

namespace App\Livewire\Guests;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest.guest-layout')]
class Home extends Component
{
    public $heroImages = [];
    public $latestPosts;

    public function mount()
    {
        $allImages = [
            'Staff member monitoring visit to Masonga Village.webp',
            'Tikondane VSL club.webp',
            'Training on business management and financial literacy.webp',
            'Training on conservation agriculture and crop management.webp',
            'Training on record keeping.webp',
            'Velentina Majoti.webp',
        ];

        // Randomly select 4 images
        $this->heroImages = collect($allImages)->shuffle()->take(4)->values()->toArray();

        // Fetch latest published posts with caching (1 hour)
        $this->latestPosts = cache()->remember('home.latest_posts', 3600, function () {
            return Post::where('is_published', true)
                ->with('category')
                ->orderBy('published_at', 'desc')
                ->take(3)
                ->get();
        });
    }

    public function render()
    {
        return view('livewire.guests.home', [
            'latestPosts' => $this->latestPosts,
        ]);
    }
}
