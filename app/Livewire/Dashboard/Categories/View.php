<?php

namespace App\Livewire\Dashboard\Categories;

use App\Models\Category;
use Livewire\Component;

class View extends Component
{
    public $category;

    public function mount($category): void
    {
        $this->category = $category;
    }

 

  

    public function render()
    {
        return view('livewire.dashboard.categories.view');
    }
}
