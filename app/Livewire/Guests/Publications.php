<?php

namespace App\Livewire\Guests;

use App\Models\HeroSection;
use App\Models\Publication;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest.guest-layout')]
class Publications extends Component
{
    public $publications;
    public $heroSection;

    public function mount()
    {
        $this->publications = cache()->remember('publications.active', 3600, function () {
            return Publication::active()->ordered()->get();
        });

        $this->heroSection = cache()->remember('publications.hero', 3600, function () {
            return HeroSection::forPage('publications');
        });
    }

    public function render()
    {
        return view('livewire.guests.publications');
    }
}
