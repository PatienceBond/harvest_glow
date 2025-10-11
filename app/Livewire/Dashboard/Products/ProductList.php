<?php

namespace App\Livewire\Dashboard\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductList extends Component
{
    public $term = '';
    public $productId = null;

    #[On('$refresh')]
    #[On('refresh-products')]
    #[On('product-saved')]
    public function refresh(): void
    {
        // No logic needed; this just forces re-render
    }

    public function updatedTerm($value)
    {
        $this->term = trim($value);

        if ($this->term === '') {
            $this->dispatch('$refresh');
        }
    }

    public function search()
    {
        $this->dispatch('$refresh');
    }

    public function create()
    {
        $this->productId = null;
        $this->dispatch('create-product');
    }

    public function edit($id)
    {
        $this->productId = $id;
        $this->dispatch('edit-product', productId: $id);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        
        if ($product) {
            // Delete image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $product->delete();
            
            $this->dispatch('showToast', message: 'Product deleted successfully!', type: 'success');
            $this->dispatch('$refresh');
        }
    }

    public function toggleActive($id)
    {
        $product = Product::find($id);
        
        if ($product) {
            $product->is_active = !$product->is_active;
            $product->save();
            
            $message = $product->is_active ? 'Product activated!' : 'Product deactivated!';
            $this->dispatch('showToast', message: $message, type: 'success');
            $this->dispatch('$refresh');
        }
    }

    public function render()
    {
        $query = Product::query();

        if ($this->term) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->term . '%')
                  ->orWhere('description', 'like', '%' . $this->term . '%');
            });
        }

        $products = $query->orderBy('order')->orderBy('created_at', 'desc')->get();

        return view('livewire.dashboard.products.product-list', [
            'products' => $products,
        ]);
    }
}
