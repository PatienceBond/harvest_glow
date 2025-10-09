<?php

namespace App\Livewire\Dashboard\Categories;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateEdit extends Component
{
    public $categoryId = null;

    public $name = '';

    public $description = '';

    public $color = '#388E3C';

    #[On('edit-category')]
    public function boot($categoryId = null): void
    {
        // Clear old data and show loading state
        $this->reset();
        if ($categoryId) {

            $category = Category::find($categoryId);
            if ($category) {

                $this->categoryId = $category->id;
                $this->name = $category->name;
                $this->description = $category->description ?? '';
                $this->color = $category->color;
            }
        }
    }

    public function save(): void
    {
        $this->validate([

            'name' => 'required|string|max:255|unique:categories,name'.($this->categoryId ? ','.$this->categoryId : ''),
            'description' => 'nullable|string|max:500',
            'color' => 'required|string|max:7',
        ]);
        try {

            $data = [
                'name' => $this->name,
                'slug' => strtolower($this->name),
                'description' => $this->description,
                'color' => $this->color,
            ];

            if ($this->categoryId) {
                $category = Category::findOrFail($this->categoryId);
                $category->update($data);
                $message = 'Category updated successfully!';
            } else {
                Category::create($data);
                $message = 'Category created successfully!';
            }

            $this->reset();
            $this->dispatch('showToast', message: $message, type: 'success');

            $this->dispatch('category-saved');
        } catch (\Exception $e) {
            $this->dispatch('showToast', message: $e->getMessage(), type: 'error');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.categories.create-edit');
    }
}
