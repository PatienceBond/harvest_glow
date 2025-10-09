<?php

namespace App\Livewire\Dashboard\Categories;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class View extends Component
{
    public $category = null;

    #[On('view-category')]
    public function loadCategory(int $categoryId): void
    {
        $this->category = Category::find($categoryId);
    }

    public function render()
    {
        return view('livewire.dashboard.categories.view');
    }
}
