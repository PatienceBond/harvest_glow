<?php

namespace App\Livewire\Dashboard\Posts;

use App\Models\Post;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.dashboard.dashboard-layout')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $categoryFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();
        
        session()->flash('message', 'Post deleted successfully.');
    }

    public function render()
    {
        $query = Post::with('category', 'user');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statusFilter) {
            if ($this->statusFilter === 'published') {
                $query->where('is_published', true);
            } elseif ($this->statusFilter === 'draft') {
                $query->where('is_published', false);
            }
        }

        if ($this->categoryFilter) {
            $query->where('category_id', $this->categoryFilter);
        }

        $posts = $query->latest()->paginate(10);
        $categories = Category::orderBy('name')->get();

        return view('livewire.dashboard.posts.index', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
}
