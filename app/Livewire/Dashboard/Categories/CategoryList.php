<?php

namespace App\Livewire\Dashboard\Categories;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryList extends Component
{
    public $term = '';

    public $categoryId = null;

    #[On('$refresh')]
    public function refresh(): void
    {
        // No logic needed; this just forces re-render
    }

    public function updatedTerm($value)
    {
        $this->term = trim($value);

        logger()->info('Updated search term:', ['term' => $this->term]);

        if ($this->term === '') {
            $this->dispatch('$refresh');
        }
    }

    public function edit(int $categoryId): void
    {

        $this->dispatch('edit-category', categoryId: $categoryId);
    }

    public function view(int $categoryId): void
    {

        $this->dispatch('view-category', categoryId: $categoryId);
    }

    public function delete($categoryId): void
    {
        $category = Category::findOrFail($categoryId);

        if ($category->posts()->count() > 0) {
            $this->dispatch('showToast', message: 'Cannot delete category with existing posts.', type: 'error');

            return;
        }

        $category->delete();

        $this->dispatch('showToast', message: 'Category deleted successfully!', type: 'success');

        $this->term = ''; // Ensures full list again
    }

    public function render()
    {
        $categories = Category::query()
            ->withCount('posts')
            ->when($this->term, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->term.'%')
                        ->orWhere('description', 'like', '%'.$this->term.'%');
                });
            })
            ->orderBy('name')
            ->limit(50)
            ->get();

        return view('livewire.dashboard.categories.category-list', [
            'categories' => $categories,
        ]);
    }
}
