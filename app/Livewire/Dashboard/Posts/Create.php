<?php

namespace App\Livewire\Dashboard\Posts;

use App\Models\Post;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard.dashboard-layout')]
class Create extends Component
{
    use WithFileUploads;

    public $title = '';
    public $excerpt = '';
    public $content = '';
    public $featured_image;
    public $is_published = false;
    public $published_at = '';
    public $category_id = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'excerpt' => 'nullable|string|max:500',
        'content' => 'required|string',
        'featured_image' => 'nullable|image|max:2048',
        'is_published' => 'boolean',
        'published_at' => 'nullable|date',
        'category_id' => 'nullable|exists:categories,id',
    ];

    public function mount()
    {
        $this->published_at = now()->format('Y-m-d\TH:i');
    }

    public function updatedTitle()
    {
        // Auto-generate slug from title - this will be used in the save method
    }

    public function save()
    {
        $this->validate();

        // Handle file upload with optimization
        $featuredImagePath = null;
        if ($this->featured_image) {
            $imageService = new ImageService();
            $result = $imageService->optimizePostImage($this->featured_image);
            $featuredImagePath = $result['path']; // Optimized: 1200px width, WebP
        }

        $post = Post::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'featured_image' => $featuredImagePath,
            'is_published' => $this->is_published,
            'published_at' => $this->is_published ? ($this->published_at ?: now()) : null,
            'user_id' => auth()->user()->id,
            'category_id' => $this->category_id ?: null,
        ]);

        $this->dispatch('showToast', [
            'type' => 'success',
            'message' => $this->is_published ? 'Post published successfully!' : 'Draft saved successfully!'
        ]);
        
        return redirect()->route('dashboard.posts.index');
    }

    public function removeFile($field)
    {
        $this->$field = null;
    }

    public function render()
    {
        $categories = Category::orderBy('name')->get();

        return view('livewire.dashboard.posts.create', [
            'categories' => $categories,
        ]);
    }
}
