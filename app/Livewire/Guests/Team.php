<?php

namespace App\Livewire\Guests;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest.guest-layout')]
class Team extends Component
{
    public function render()
    {
        return view('livewire.guests.team');
    }
}
