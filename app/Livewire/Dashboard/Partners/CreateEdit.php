<?php

namespace App\Livewire\Dashboard\Partners;

use App\Models\Partner;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public $partnerId = null;
    public $name = '';
    public $description = '';
    public $website = '';
    public $category = 'Strategic Partner';
    public $logo;
    public $existing_logo;
    public $order = 0;
    public $is_active = true;

    #[On('edit-partner')]
    public function loadPartner(int $partnerId): void
    {
        // Clear old data first
        $this->partnerId = null;
        $this->name = '';
        $this->description = '';
        $this->website = '';
        $this->category = 'Strategic Partner';
        $this->logo = null;
        $this->existing_logo = null;
        $this->order = 0;
        $this->is_active = true;

        // Load the partner
        $partner = Partner::find($partnerId);
        if ($partner) {
            $this->partnerId = $partner->id;
            $this->name = $partner->name;
            $this->description = $partner->description;
            $this->website = $partner->website;
            $this->category = $partner->category;
            $this->existing_logo = $partner->logo;
            $this->order = $partner->order;
            $this->is_active = $partner->is_active;
        }
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'website' => 'nullable|url|max:255',
            'category' => 'required|in:Strategic Partner,Research Partner,Implementation Partner',
            'logo' => 'nullable|image|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            // Handle file upload
            $logoPath = $this->existing_logo;

            if ($this->logo) {
                // Delete old logo if exists
                if ($this->existing_logo && Storage::disk('public')->exists($this->existing_logo)) {
                    Storage::disk('public')->delete($this->existing_logo);
                }

                // Optimize and store new logo (400x400px square for logos)
                $imageService = new ImageService();
                $result = $imageService->optimizeAndSave($this->logo, 'partners', 400, 400, 90);
                $logoPath = $result['path'];
            }

            $data = [
                'name' => $this->name,
                'description' => $this->description,
                'website' => $this->website,
                'category' => $this->category,
                'logo' => $logoPath,
                'order' => $this->order,
                'is_active' => $this->is_active,
            ];

            if ($this->partnerId) {
                Partner::find($this->partnerId)->update($data);
                $message = 'Partner updated successfully!';
            } else {
                Partner::create($data);
                $message = 'Partner added successfully!';
            }

            $this->reset();
            $this->dispatch('showToast', message: $message, type: 'success');
            $this->dispatch('partner-saved');
            $this->dispatch('refresh-partners');
        } catch (\Exception $e) {
            $this->dispatch('showToast', message: $e->getMessage(), type: 'error');
        }
    }

    public function removeFile(): void
    {
        $this->logo = null;
    }

    public function removeExistingLogo(): void
    {
        $this->existing_logo = null;
    }

    public function render()
    {
        return view('livewire.dashboard.partners.create-edit');
    }
}

