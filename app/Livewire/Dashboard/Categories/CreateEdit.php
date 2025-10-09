<?php

namespace App\Livewire\Dashboard\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateEdit extends Component
{
    public $categoryId = null;

    public $name = '';

    public $description = '';

    public $color = '#388E3C';



    public function mount($category = null): void
    {
        if ($category) {
            $this->categoryId = $category->id;
            $this->name = $category->name;
            $this->description = $category->description ?? '';
            $this->color = $category->color;
        }
    }

    public function save(): void
    {
        $this->validate([
            
            'name' => 'required|string|max:255|unique:categories,name' . ($this->categoryId ? ',' . $this->categoryId : ''),
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

                $this->category->update($data);
                $message = 'Category updated successfully!';
            } else {
                Category::create($data);
                $message = 'Category created successfully!';
            }

            $this->dispatch('showToast', [
                'type' => 'success',
                'message' => $message,
            ]);

            $this->dispatch('category-saved');
        } catch (\Exception $e) {
            $this->dispatch('showToast', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }



    public function render()
    {
        return view('livewire.dashboard.categories.create-edit');
    }
}
