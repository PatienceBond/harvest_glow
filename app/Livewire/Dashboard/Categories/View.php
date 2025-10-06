<?php

namespace App\Livewire\Dashboard\Categories;

use App\Models\Category;
use Livewire\Component;

class View extends Component
{
    public $category;

    public function mount($categoryId): void
    {
        $this->category = Category::withCount('posts')->findOrFail($categoryId);
    }

    public function close(): void
    {
        $this->dispatch('close-modal');
    }

    public function edit(): void
    {
        $this->dispatch('close-modal');
        $this->dispatch('edit-category', categoryId: $this->category->id);
    }

    public function render()
    {
        return view('livewire.dashboard.categories.view');
    }
}
