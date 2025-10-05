<?php

namespace App\Livewire\Dashboard\Metrics;

use App\Models\ImpactMetric;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard.dashboard-layout')]
class Index extends Component
{
    public $showModal = false;
    public $editing = false;
    public $title = '';
    public $value = '';
    public $unit = '';
    public $description = '';
    public $icon = '';
    public $color = '#388E3C';
    public $is_featured = false;
    public $sort_order = 0;
    public $metricId = null;

    protected $rules = [
        'title' => 'required|string|max:255',
        'value' => 'required|string|max:100',
        'unit' => 'nullable|string|max:50',
        'description' => 'nullable|string|max:500',
        'icon' => 'nullable|string|max:10',
        'color' => 'required|string|max:7',
        'is_featured' => 'boolean',
        'sort_order' => 'integer|min:0',
    ];

    public function create()
    {
        $this->reset([
            'title', 'value', 'unit', 'description', 'icon', 'color', 
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
        $this->icon = $metric->icon;
        $this->color = $metric->color;
        $this->is_featured = $metric->is_featured;
        $this->sort_order = $metric->sort_order;
        $this->editing = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'value' => $this->value,
            'unit' => $this->unit,
            'description' => $this->description,
            'icon' => $this->icon,
            'color' => $this->color,
            'is_featured' => $this->is_featured,
            'sort_order' => $this->sort_order,
        ];

        if ($this->editing) {
            $metric = ImpactMetric::findOrFail($this->metricId);
            $metric->update($data);
            session()->flash('message', 'Metric updated successfully!');
        } else {
            ImpactMetric::create($data);
            session()->flash('message', 'Metric created successfully!');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $metric = ImpactMetric::findOrFail($id);
        $metric->delete();
        session()->flash('message', 'Metric deleted successfully!');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset([
            'title', 'value', 'unit', 'description', 'icon', 'color', 
            'is_featured', 'sort_order', 'metricId', 'editing'
        ]);
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
