<?php

namespace App\Livewire\Dashboard\Posts;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard.dashboard-layout')]
class Edit extends Component
{
    public Post $post;
    public $title = '';
    public $excerpt = '';
    public $content = '';
    public $featured_image = '';
    public $is_published = false;
    public $published_at = '';
    public $category_id = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'excerpt' => 'nullable|string|max:500',
        'content' => 'required|string',
        'featured_image' => 'nullable|url',
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
        $this->featured_image = $post->featured_image;
        $this->is_published = $post->is_published;
        $this->published_at = $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '';
        $this->category_id = $post->category_id;
    }

    public function update()
    {
        $this->validate();

        $this->post->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'featured_image' => $this->featured_image,
            'is_published' => $this->is_published,
            'published_at' => $this->is_published ? ($this->published_at ?: now()) : null,
            'category_id' => $this->category_id ?: null,
        ]);

        session()->flash('message', 'Post updated successfully!');
        
        return redirect()->route('dashboard.posts.index');
    }

    public function render()
    {
        $categories = Category::orderBy('name')->get();

        return view('livewire.dashboard.posts.edit', [
            'categories' => $categories,
        ]);
    }
}
