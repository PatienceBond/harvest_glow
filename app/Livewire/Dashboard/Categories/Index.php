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

    public function openCreate(): void
    {
        $this->editingCategoryId = null;
        $this->showCreateEdit = true;
        $this->showView = false;
    }

    #[On('openCreate')]
    public function openCreateFromEvent(): void
    {
        $this->openCreate();
    }

    #[On('edit-category')]
    public function openEdit($categoryId): void
    {
        $this->editingCategoryId = $categoryId;
        $this->showCreateEdit = true;
        $this->showView = false;
    }

    #[On('view-category')]
    public function openView($categoryId): void
    {
        $this->viewingCategoryId = $categoryId;
        $this->showView = true;
        $this->showCreateEdit = false;
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->showCreateEdit = false;
        $this->showView = false;
        $this->editingCategoryId = null;
        $this->viewingCategoryId = null;
    }

    #[On('category-saved')]
    public function categorySaved(): void
    {
        $this->closeModal();
        $this->dispatch('$refresh');
    }

    // Removed unnecessary refresh dispatching for better performance

    public function render()
    {
        return view('livewire.dashboard.categories.index');
    }
}
