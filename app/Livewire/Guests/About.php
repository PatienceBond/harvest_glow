<?php

namespace App\Livewire\Guests;

use App\Models\HeroSection;
use Livewire\Component;

class About extends Component
{
    public $heroSection;

    public function mount()
    {
        // Fetch hero section for about page
        $this->heroSection = cache()->remember('about.hero', 3600, function () {
            return HeroSection::forPage('about');
        });
    }

    public function render()
    {
        return view('livewire.guests.about')
            ->layout('components.layouts.guest.guest-layout');
    }
}
