<?php

namespace App\Livewire\Dashboard\Categories;

use Livewire\Component;


use Livewire\Attributes\Layout;
use Livewire\Attributes\On;


#[Layout('components.layouts.dashboard.dashboard-layout')]
class CategoryPage extends Component
{
    public function render()
    {
        return view('livewire.dashboard.categories.category-page');
        // return "<h1>hello</h1>";
    }
}
