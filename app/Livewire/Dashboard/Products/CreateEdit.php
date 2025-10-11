<?php

namespace App\Livewire\Dashboard\Products;

use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use WithFileUploads;

    public $productId = null;

    public $title = '';

    public $description = '';

    public $image;

    public $existing_image;

    public $order = 0;

    public $is_active = true;

    #[On('edit-product')]
    public function loadProduct(int $productId): void
    {
        // Clear old data first
        $this->productId = null;
        $this->title = '';
        $this->description = '';
        $this->image = null;
        $this->existing_image = null;
        $this->order = 0;
        $this->is_active = true;

        // Load the product
        $product = Product::find($productId);
        if ($product) {
            $this->productId = $product->id;
            $this->title = $product->title;
            $this->description = $product->description;
            $this->existing_image = $product->image;
            $this->order = $product->order;
            $this->is_active = $product->is_active;
        }
    }

    public function save(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        try {
            // Handle file upload
            $imagePath = $this->existing_image;

            if ($this->image) {
                // Delete old image if exists
                if ($this->existing_image && Storage::disk('public')->exists($this->existing_image)) {
                    Storage::disk('public')->delete($this->existing_image);
                }

                // Optimize and store new image (800x600px, WebP)
                $imageService = new ImageService;
                $result = $imageService->optimizeAndSave($this->image, 'products', 800, 600, 85);
                $imagePath = $result['path'];
            }

            $data = [
                'title' => $this->title,
                'description' => $this->description,
                'image' => $imagePath,
                'order' => $this->order,
                'is_active' => $this->is_active,
            ];

            if ($this->productId) {
                Product::find($this->productId)->update($data);
                $message = 'Product updated successfully!';
            } else {
                Product::create($data);
                $message = 'Product added successfully!';
            }

            $this->reset();
            $this->dispatch('showToast', message: $message, type: 'success');
            $this->dispatch('product-saved');
            $this->dispatch('refresh-products');
        } catch (\Exception $e) {
            $this->dispatch('showToast', message: $e->getMessage(), type: 'error');
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
        return view('livewire.dashboard.products.create-edit');
    }
}
