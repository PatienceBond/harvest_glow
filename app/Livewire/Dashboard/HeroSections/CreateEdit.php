<?php

namespace App\Livewire\Dashboard\HeroSections;

use App\Models\HeroImage;
use App\Models\HeroSection;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public $heroId = null;

    public $page = '';

    public $heading = '';

    public $subheading = '';

    public $image;

    public $existing_image;

    public $sliderImages = []; // For multiple images

    public $existingSliderImages = [];

    public $height = '500px';

    public $is_active = true;

    #[On('edit-hero')]
    public function loadHero(int $heroId): void
    {
        // Clear old data first
        $this->heroId = null;
        $this->page = '';
        $this->heading = '';
        $this->subheading = '';
        $this->image = null;
        $this->existing_image = null;
        $this->sliderImages = [];
        $this->existingSliderImages = [];
        $this->height = '500px';
        $this->is_active = true;

        // Load the hero
        $hero = HeroSection::with('images')->find($heroId);
        if ($hero) {
            $this->heroId = $hero->id;
            $this->page = $hero->page;
            $this->heading = $hero->heading;
            $this->subheading = $hero->subheading;
            $this->existing_image = $hero->image;
            $this->height = $hero->height;
            $this->is_active = $hero->is_active;

            // Load existing slider images
            $this->existingSliderImages = $hero->images->toArray();
        }
    }

    public function save(): void
    {
        $this->validate([
            'page' => ['required', 'string', Rule::unique('hero_sections', 'page')->ignore($this->heroId)],
            'heading' => 'required|string|max:255',
            'subheading' => 'nullable|string|max:500',
            'image' => 'nullable|image',
            'sliderImages.*' => 'nullable|image',
            'height' => 'required|string',
            'is_active' => 'boolean',
        ]);

        try {
            // Handle main image upload
            $imagePath = $this->existing_image;

            if ($this->image) {
                // Delete old image if exists
                if ($this->existing_image && Storage::disk('public')->exists($this->existing_image)) {
                    Storage::disk('public')->delete($this->existing_image);
                }

                // Optimize and store new image (1920x1080px for hero images)
                $imageService = new ImageService;
                $result = $imageService->optimizeAndSave($this->image, 'heroes', 1920, 1080, 85);
                $imagePath = $result['path'];
            }

            $data = [
                'page' => $this->page,
                'heading' => $this->heading,
                'subheading' => $this->subheading,
                'image' => $imagePath,
                'height' => $this->height,
                'is_active' => $this->is_active,
            ];

            if ($this->heroId) {
                $hero = HeroSection::find($this->heroId);
                $hero->update($data);
                $message = 'Hero section updated successfully!';
            } else {
                $hero = HeroSection::create($data);
                $message = 'Hero section added successfully!';
            }

            // Handle multiple slider images (for home page)
            if ($this->sliderImages && count($this->sliderImages) > 0) {
                $imageService = new ImageService;
                $order = $hero->images()->count(); // Start order after existing images

                foreach ($this->sliderImages as $sliderImage) {
                    if ($sliderImage) {
                        $result = $imageService->optimizeAndSave($sliderImage, 'heroes', 1920, 1080, 85);

                        HeroImage::create([
                            'hero_section_id' => $hero->id,
                            'image_path' => $result['path'],
                            'order' => $order++,
                        ]);
                    }
                }
            }

            $this->reset();
            $this->dispatch('showToast', message: $message, type: 'success');
            $this->dispatch('hero-saved');
            $this->dispatch('refresh-heroes');
        } catch (\Exception $e) {
            $this->dispatch('showToast', message: $e->getMessage(), type: 'error');
        }
    }

    public function deleteSliderImage($imageId)
    {
        $heroImage = HeroImage::find($imageId);

        if ($heroImage) {
            // Delete file from storage
            if (Storage::disk('public')->exists($heroImage->image_path)) {
                Storage::disk('public')->delete($heroImage->image_path);
            }

            $heroImage->delete();

            // Refresh the existing images
            $hero = HeroSection::with('images')->find($this->heroId);
            $this->existingSliderImages = $hero->images->toArray();

            $this->dispatch('showToast', message: 'Slider image deleted!', type: 'success');
        }
    }

    public function removeFile(): void
    {
        $this->image = null;
    }

    public function removeExistingImage(): void
    {
        $this->existing_image = null;
    }

    public function render()
    {
        return view('livewire.dashboard.hero-sections.create-edit');
    }
}
