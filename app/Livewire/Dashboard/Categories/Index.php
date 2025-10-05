<?php

namespace App\Livewire\Dashboard\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard.dashboard-layout')]
class Index extends Component
{
    public $showModal = false;
    public $editing = false;
    public $name = '';
    public $description = '';
    public $color = '#388E3C';
    public $categoryId = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'color' => 'required|string|max:7',
    ];

    public function create()
    {
        $this->reset(['name', 'description', 'color', 'categoryId', 'editing']);
        $this->showModal = true;
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->color = $category->color;
        $this->editing = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'color' => $this->color,
        ];

        if ($this->editing) {
            $category = Category::findOrFail($this->categoryId);
            $category->update($data);
            session()->flash('message', 'Category updated successfully!');
        } else {
            Category::create($data);
            session()->flash('message', 'Category created successfully!');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        
        if ($category->posts()->count() > 0) {
            session()->flash('error', 'Cannot delete category with existing posts.');
            return;
        }

        $category->delete();
        session()->flash('message', 'Category deleted successfully!');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['name', 'description', 'color', 'categoryId', 'editing']);
    }

    public function render()
    {
        $categories = Category::withCount('posts')->orderBy('name')->get();

        return view('livewire.dashboard.categories.index', [
            'categories' => $categories,
        ]);
    }
}
