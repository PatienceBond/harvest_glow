<?php

namespace App\Livewire\Dashboard\Posts;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard.dashboard-layout')]
class PostPage extends Component
{
    public function render()
    {
        return view('livewire.dashboard.posts.post-page');
    }
}
