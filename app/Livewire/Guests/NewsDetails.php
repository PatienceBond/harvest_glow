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
    public $relatedPosts;

    public function mount($slug = null)
    {
        $this->slug = $slug;
        
        // Fetch post from database by slug with caching (1 hour)
        $this->post = cache()->remember("post.{$slug}", 3600, function () use ($slug) {
            return Post::where('slug', $slug)
                ->where('is_published', true)
                ->with('category')
                ->first();
        });
        
        // Fetch related posts if post exists with caching (1 hour)
        if ($this->post) {
            $this->relatedPosts = cache()->remember("post.{$slug}.related", 3600, function () {
                return Post::where('is_published', true)
                    ->where('id', '!=', $this->post->id)
                    ->with('category')
                    ->orderBy('published_at', 'desc')
                    ->take(3)
                    ->get();
            });
        } else {
            $this->relatedPosts = collect();
        }
    }

    public function render()
    {
        return view('livewire.guests.news-details', [
            'relatedPosts' => $this->relatedPosts,
        ]);
    }
}
