<?php

namespace App\Livewire\Dashboard\Posts;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class PostList extends Component
{
    public $term = '';

    public $statusFilter = '';

    public $categoryFilter = '';

    public $postId = null;

    #[On('$refresh')]
    #[On('refresh-posts')]
    #[On('post-saved')]
    public function refresh(): void
    {
        // No logic needed; this just forces re-render
    }

    public function updatedTerm($value)
    {
        $this->term = trim($value);

        if ($this->term === '') {
            $this->dispatch('$refresh');
        }
    }

    public function edit(int $postId): void
    {
        $this->dispatch('edit-post', postId: $postId);
    }

    public function view(int $postId): void
    {
        $this->dispatch('view-post', postId: $postId);
    }

    public function delete($postId): void
    {
        $post = Post::findOrFail($postId);

        $post->delete();

        $this->dispatch('showToast', message: 'Post deleted successfully!', type: 'success');

        $this->term = ''; // Ensures full list again
    }

    public function render()
    {
        $posts = Post::query()
            ->with('category', 'user')
            ->when($this->term, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%'.$this->term.'%')
                        ->orWhere('excerpt', 'like', '%'.$this->term.'%')
                        ->orWhere('content', 'like', '%'.$this->term.'%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                if ($this->statusFilter === 'published') {
                    $query->where('is_published', true);
                } elseif ($this->statusFilter === 'draft') {
                    $query->where('is_published', false);
                }
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('category_id', $this->categoryFilter);
            })
            ->latest()
            ->limit(50)
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('livewire.dashboard.posts.post-list', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
}
