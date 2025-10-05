<?php

namespace App\Livewire\Guests;

use Livewire\Component;

class Home extends Component
{
    public $heroImages = [];

    public function mount()
    {
        $allImages = [
            'Staff member monitoring visit to Masonga Village.webp',
            'Tikondane VSL club.webp',
            'Training on business management and financial literacy.webp',
            'Training on conservation agriculture and crop management.webp',
            'Training on record keeping.webp',
            'Velentina Majoti.webp',
        ];

        // Randomly select 4 images
        $this->heroImages = collect($allImages)->shuffle()->take(4)->values()->toArray();
    }

    public function render()
    {
        return view('livewire.guests.home')
            ->layout('components.layouts.guest.guest-layout');
    }
}
