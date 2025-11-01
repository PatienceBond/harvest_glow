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

    protected function formatContentForReadability($content, int $minWords = 50, int $maxWords = 70)
    {
        if (!$content) {
            return '';
        }

        // If content likely contains HTML, return as-is
        if ($content !== strip_tags($content)) {
            return $content;
        }

        $text = trim(preg_replace('/\s+/u', ' ', $content));
        if ($text === '') {
            return '';
        }

        $sentences = preg_split('/(?<=[\.\!\?])\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY);
        if (!$sentences) {
            return '<p>' . e($text) . '</p>';
        }

        $paragraphs = [];
        $current = [];
        $count = 0;
        foreach ($sentences as $s) {
            $s = trim($s);
            if ($s === '') continue;
            $wordsInSentence = count(preg_split('/\s+/u', $s));
            if ($count >= $minWords && ($count + $wordsInSentence) > $maxWords) {
                $paragraphs[] = '<p>' . e(implode(' ', $current)) . '</p>';
                $current = [];
                $count = 0;
            }
            $current[] = $s;
            $count += $wordsInSentence;
        }
        if (!empty($current)) {
            $paragraphs[] = '<p>' . e(implode(' ', $current)) . '</p>';
        }
        return implode('', $paragraphs);
    }

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
            'renderedContent' => $this->formatContentForReadability($this->post?->content ?? ''),
        ]);
    }
}
