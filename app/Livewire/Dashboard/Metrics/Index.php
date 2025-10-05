<?php

namespace App\Livewire\Dashboard\Metrics;

use App\Models\ImpactMetric;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard.dashboard-layout')]
class Index extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $editing = false;
    public $title = '';
    public $value = '';
    public $unit = '';
    public $description = '';
    public $icon_emoji = '';
    public $icon_image;
    public $color = '#388E3C';
    public $is_featured = false;
    public $sort_order = 0;
    public $metricId = null;

    protected $rules = [
        'title' => 'required|string|max:255',
        'value' => 'required|string|max:100',
        'unit' => 'nullable|string|max:50',
        'description' => 'nullable|string|max:500',
        'icon_emoji' => 'nullable|string|max:10',
        'icon_image' => 'nullable|image|max:512',
        'color' => 'required|string|max:7',
        'is_featured' => 'boolean',
        'sort_order' => 'integer|min:0',
    ];

    public function create()
    {
        $this->reset([
            'title', 'value', 'unit', 'description', 'icon_emoji', 'icon_image', 'color', 
            'is_featured', 'sort_order', 'metricId', 'editing'
        ]);
        $this->showModal = true;
    }

    public function edit($id)
    {
        $metric = ImpactMetric::findOrFail($id);
        $this->metricId = $metric->id;
        $this->title = $metric->title;
        $this->value = $metric->value;
        $this->unit = $metric->unit;
        $this->description = $metric->description;
        $this->icon_emoji = $metric->icon;
        $this->color = $metric->color;
        $this->is_featured = $metric->is_featured;
        $this->sort_order = $metric->sort_order;
        $this->editing = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        // Handle icon - prioritize emoji, fallback to uploaded image
        $icon = $this->icon_emoji;
        if ($this->icon_image) {
            $iconPath = $this->icon_image->store('metrics', 'public');
            $icon = $iconPath;
        }

        $data = [
            'title' => $this->title,
            'value' => $this->value,
            'unit' => $this->unit,
            'description' => $this->description,
            'icon' => $icon,
            'color' => $this->color,
            'is_featured' => $this->is_featured,
            'sort_order' => $this->sort_order,
        ];

        if ($this->editing) {
            $metric = ImpactMetric::findOrFail($this->metricId);
            $metric->update($data);
            $this->dispatch('showToast', [
                'type' => 'success',
                'message' => 'Metric updated successfully!'
            ]);
        } else {
            ImpactMetric::create($data);
            $this->dispatch('showToast', [
                'type' => 'success',
                'message' => 'Metric created successfully!'
            ]);
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $metric = ImpactMetric::findOrFail($id);
        $metric->delete();
        $this->dispatch('showToast', [
            'type' => 'success',
            'message' => 'Metric deleted successfully!'
        ]);
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset([
            'title', 'value', 'unit', 'description', 'icon_emoji', 'icon_image', 'color', 
            'is_featured', 'sort_order', 'metricId', 'editing'
        ]);
    }

    public function removeFile($field)
    {
        $this->$field = null;
    }

    public function render()
    {
        $featuredMetrics = ImpactMetric::featured()->ordered()->get();
        $metrics = ImpactMetric::ordered()->get();

        return view('livewire.dashboard.metrics.index', [
            'featuredMetrics' => $featuredMetrics,
            'metrics' => $metrics,
        ]);
    }
}
