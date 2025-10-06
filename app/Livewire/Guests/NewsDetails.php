<?php

namespace App\Livewire\Guests;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest.guest-layout')]
class NewsDetails extends Component
{
    public $slug;
    public $post;

    public function mount($slug = null)
    {
        $this->slug = $slug;
        
        // Fetch post from database by slug
        $this->post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->with('category')
            ->first();
    }

    public function render()
    {
        return view('livewire.guests.news-details');
    }
}
