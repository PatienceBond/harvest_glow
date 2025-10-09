<?php

namespace App\Livewire\Dashboard\Posts;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class View extends Component
{
    public $post = null;

    #[On('view-post')]
    public function loadPost(int $postId): void
    {
        $this->post = Post::with('category', 'user')->find($postId);
    }

    public function render()
    {
        return view('livewire.dashboard.posts.view');
    }
}
