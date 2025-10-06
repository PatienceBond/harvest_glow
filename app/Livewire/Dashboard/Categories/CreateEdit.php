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

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'color' => 'required|string|max:7',
    ];

    public function mount($categoryId = null): void
    {
        if ($categoryId) {
            $this->categoryId = $categoryId;
            $category = Category::findOrFail($categoryId);
            $this->name = $category->name;
            $this->description = $category->description;
            $this->color = $category->color;
        }
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
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

        $this->dispatch('showToast', [
            'type' => 'success',
            'message' => $message,
        ]);

        $this->dispatch('category-saved');
    }

    public function cancel(): void
    {
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.categories.create-edit');
    }
}
