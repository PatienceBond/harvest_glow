<?php

namespace App\Livewire\Guests;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('livewire.guests.about')
            ->layout('components.layouts.guest.guest-layout');
    }
}
