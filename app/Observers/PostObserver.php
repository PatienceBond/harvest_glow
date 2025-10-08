<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    /**
     * Clear relevant caches when post changes
     */
    private function clearPostCaches(Post $post): void
    {
        // Clear home page latest posts cache
        Cache::forget('home.latest_posts');
        
        // Clear specific post cache
        Cache::forget("post.{$post->slug}");
        Cache::forget("post.{$post->slug}.related");
        
        // Clear all related posts caches (they might include this post)
        // This is a simple approach - for production, consider using cache tags
        $allPosts = Post::where('is_published', true)->pluck('slug');
        foreach ($allPosts as $slug) {
            Cache::forget("post.{$slug}.related");
        }
    }

    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        if ($post->is_published) {
            $this->clearPostCaches($post);
        }
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        // Clear cache whether published or not (in case it was unpublished)
        $this->clearPostCaches($post);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $this->clearPostCaches($post);
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        if ($post->is_published) {
            $this->clearPostCaches($post);
        }
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        $this->clearPostCaches($post);
    }
}
