<?php

namespace App\Livewire\Guests;

use App\Models\HeroSection;
use Livewire\Component;

class OurModel extends Component
{
    public $heroSection;

    public function mount()
    {
        // Fetch hero section for our-model page
        $this->heroSection = cache()->remember('our-model.hero', 3600, function () {
            return HeroSection::forPage('our-model');
        });
    }

    public function render()
    {
        return view('livewire.guests.our-model')
            ->layout('components.layouts.guest.guest-layout');
    }
}
