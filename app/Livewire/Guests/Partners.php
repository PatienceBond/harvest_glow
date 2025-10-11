<?php

namespace App\Livewire\Guests;

use App\Models\Partner;
use App\Models\HeroSection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest.guest-layout')]
class Partners extends Component
{
    public $strategicPartners;
    public $researchPartners;
    public $implementationPartners;
    public $heroSection;

    public function mount()
    {
        // Fetch strategic partners
        $this->strategicPartners = cache()->remember('partners.strategic', 3600, function () {
            return Partner::active()
                ->where('category', 'Strategic Partner')
                ->ordered()
                ->get();
        });

        // Fetch research partners
        $this->researchPartners = cache()->remember('partners.research', 3600, function () {
            return Partner::active()
                ->where('category', 'Research Partner')
                ->ordered()
                ->get();
        });

        // Fetch implementation partners
        $this->implementationPartners = cache()->remember('partners.implementation', 3600, function () {
            return Partner::active()
                ->where('category', 'Implementation Partner')
                ->ordered()
                ->get();
        });

        // Fetch hero section for partners page
        $this->heroSection = cache()->remember('partners.hero', 3600, function () {
            return HeroSection::forPage('partners');
        });
    }

    public function render()
    {
        return view('livewire.guests.partners');
    }
}
