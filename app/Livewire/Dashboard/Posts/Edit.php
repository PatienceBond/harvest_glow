<?php

namespace App\Livewire\Dashboard\Posts;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard.dashboard-layout')]
class Edit extends Component
{
    use WithFileUploads;

    public Post $post;

    public $title = '';

    public $excerpt = '';

    public $content = '';

    public $featured_image; // For NEW uploads only

    public $existing_featured_image; // For existing image path

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

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->excerpt = $post->excerpt;
        $this->content = $post->content;
        $this->existing_featured_image = $post->featured_image; // Store existing image path
        $this->is_published = $post->is_published;
        $this->published_at = $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '';
        $this->category_id = $post->category_id;
    }

    public function update()
    {
        $this->validate();

        // Handle file upload - only update if new file is uploaded
        $featuredImagePath = $this->existing_featured_image; // Keep existing if no new upload

        if ($this->featured_image) {
            // Delete old image if exists
            if ($this->existing_featured_image && \Storage::disk('public')->exists($this->existing_featured_image)) {
                \Storage::disk('public')->delete($this->existing_featured_image);
            }

            // Store new image
            $featuredImagePath = $this->featured_image->store('posts', 'public');
        }

        $this->post->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'featured_image' => $featuredImagePath,
            'is_published' => $this->is_published,
            'published_at' => $this->is_published ? ($this->published_at ?: now()) : null,
            'category_id' => $this->category_id ?: null,
        ]);

        $this->dispatch('showToast', [
            'type' => 'success',
            'message' => 'Post updated successfully!',
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

        return view('livewire.dashboard.posts.edit', [
            'categories' => $categories,
        ]);
    }
}
