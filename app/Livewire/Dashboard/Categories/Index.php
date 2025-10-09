<?php

namespace App\Livewire\Dashboard\Categories;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components.layouts.dashboard.dashboard-layout')]
class Index extends Component
{
    public $search = '';

    public bool $showCreateEdit = false;

    public bool $showView = false;

    public ?int $editingCategoryId = null;

    public ?int $viewingCategoryId = null;

    #[On('edit-category')]
    public function openEdit($categoryId): void
    {
        $this->editingCategoryId = $categoryId;
    }

    #[On('view-category')]
    public function openView($categoryId): void
    {
        $this->viewingCategoryId = $categoryId;
    }

    #[On('category-saved')]
    public function categorySaved(): void
    {
        $this->editingCategoryId = null;
        $this->dispatch('$refresh');
    }

    // Removed unnecessary refresh dispatching for better performance

    public function render()
    {
        // return view('livewire.dashboard.categories.index');
        return "<h1>hello</h1>";
    }
}
