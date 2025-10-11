<?php

namespace App\Livewire\Dashboard\Posts;

use App\Models\Category;
use App\Models\Post;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public $postId = null;

    public $title = '';

    public $excerpt = '';

    public $content = '';

    public $featured_image;

    public $existing_featured_image;

    public $is_published = false;

    public $published_at = '';

    public $category_id = '';

    #[On('edit-post')]
    public function loadPost(int $postId): void
    {
        // Clear old data first
        $this->postId = null;
        $this->title = '';
        $this->excerpt = '';
        $this->content = '';
        $this->featured_image = null;
        $this->existing_featured_image = null;
        $this->is_published = false;
        $this->published_at = '';
        $this->category_id = '';

        // Load the post
        $post = Post::find($postId);
        if ($post) {
            $this->postId = $post->id;
            $this->title = $post->title;
            $this->excerpt = $post->excerpt ?? '';
            $this->content = $post->content;
            $this->existing_featured_image = $post->featured_image;
            $this->is_published = $post->is_published;
            $this->published_at = $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '';
            $this->category_id = $post->category_id ?? '';
        }
    }

    public function save(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        try {
            // Handle file upload
            $featuredImagePath = $this->existing_featured_image;

            if ($this->featured_image) {
                // Delete old image if exists
                if ($this->existing_featured_image && Storage::disk('public')->exists($this->existing_featured_image)) {
                    Storage::disk('public')->delete($this->existing_featured_image);
                }

                // Optimize and store new image (1200px width, WebP, with thumbnail)
                $imageService = new ImageService();
                $result = $imageService->optimizePostImage($this->featured_image);
                $featuredImagePath = $result['path']; // Main optimized image
                // Note: thumbnail is at $result['thumbnail'] if needed later
            }

            $data = [
                'title' => $this->title,
                'slug' => Str::slug($this->title),
                'excerpt' => $this->excerpt,
                'content' => $this->content,
                'featured_image' => $featuredImagePath,
                'is_published' => $this->is_published,
                'published_at' => $this->is_published ? ($this->published_at ?: now()) : null,
                'category_id' => $this->category_id ?: null,
            ];

            if ($this->postId) {
                $post = Post::findOrFail($this->postId);
                $post->update($data);
                $message = 'Post updated successfully!';
            } else {
                $data['user_id'] = auth()->id();
                Post::create($data);
                $message = $this->is_published ? 'Post published successfully!' : 'Draft saved successfully!';
            }

            $this->reset();
            $this->dispatch('showToast', message: $message, type: 'success');

            $this->dispatch('post-saved');
            $this->dispatch('refresh-posts'); // Trigger list refresh
        } catch (\Exception $e) {
            $this->dispatch('showToast', message: $e->getMessage(), type: 'error');
        }
    }

    public function removeFile(): void
    {
        $this->featured_image = null;
    }

    public function removeExistingImage(): void
    {
        $this->existing_featured_image = null;
    }

    public function render()
    {
        $categories = Category::orderBy('name')->get();

        return view('livewire.dashboard.posts.create-edit', [
            'categories' => $categories,
        ]);
    }
}
