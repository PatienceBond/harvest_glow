<?php

namespace App\Livewire\Guests;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest.guest-layout')]
class LoaderDemo extends Component
{
    public function testForm()
    {
        // Simulate some processing time
        sleep(2);
        
        // You can add any form processing logic here
        session()->flash('message', 'Form submitted successfully!');
    }

    public function render()
    {
        return view('livewire.guests.loader-demo');
    }
}
