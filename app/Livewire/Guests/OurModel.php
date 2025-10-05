<?php

namespace App\Livewire\Guests;

use Livewire\Component;

class OurModel extends Component
{
    public function render()
    {
        return view('livewire.guests.our-model')
            ->layout('components.layouts.guest.guest-layout');
    }
}
