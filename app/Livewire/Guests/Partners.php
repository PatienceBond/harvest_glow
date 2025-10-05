<?php

namespace App\Livewire\Guests;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest.guest-layout')]
class Partners extends Component
{
    public function render()
    {
        return view('livewire.guests.partners');
    }
}
