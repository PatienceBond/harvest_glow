<?php

namespace App\Livewire\Dashboard\Categories;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryList extends Component
{
    public $search = '';

    #[On('$refresh')]
    public function refresh(): void
    {
        // Force refresh of component
    }

    public function delete($categoryId): void
    {
        $category = Category::findOrFail($categoryId);

        if ($category->posts()->count() > 0) {
            $this->dispatch('showToast', [
                'type' => 'error',
                'message' => 'Cannot delete category with existing posts.',
            ]);

            return;
        }

        $category->delete();

        $this->dispatch('showToast', [
            'type' => 'success',
            'message' => 'Category deleted successfully!',
        ]);

        $this->dispatch('$refresh');
    }

    public function render()
    {
        $categories = Category::withCount('posts')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->orderBy('name')
            ->get();

        return view('livewire.dashboard.categories.category-list', [
            'categories' => $categories,
        ]);
    }
}
