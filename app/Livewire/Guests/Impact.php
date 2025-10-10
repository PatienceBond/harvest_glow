<?php

namespace App\Livewire\Guests;

use App\Models\ImpactMetric;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest.guest-layout')]
class Impact extends Component
{
    public $featuredMetrics;
    public $allMetrics;

    public function mount()
    {
        // Fetch featured metrics
        $this->featuredMetrics = cache()->remember('impact.featured_metrics', 3600, function () {
            return ImpactMetric::featured()->ordered()->get();
        });

        // Fetch all metrics for detailed display
        $this->allMetrics = cache()->remember('impact.all_metrics', 3600, function () {
            return ImpactMetric::ordered()->get();
        });
    }

    public function render()
    {
        return view('livewire.guests.impact', [
            'featuredMetrics' => $this->featuredMetrics,
            'allMetrics' => $this->allMetrics,
        ]);
    }
}
