<?php

namespace App\Livewire\Dashboard\Publications;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard.dashboard-layout')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.publications.index');
    }
}
