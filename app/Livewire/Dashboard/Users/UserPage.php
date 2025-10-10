<?php

namespace App\Livewire\Dashboard\Users;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard.dashboard-layout')]
class UserPage extends Component
{
    public function render()
    {
        return view('livewire.dashboard.users.user-page');
    }
}

