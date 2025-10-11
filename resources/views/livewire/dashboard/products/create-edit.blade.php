<flux:modal name="product-form" class="min-w-[600px]">
    <div>
        <div class="py-4">
            <h3 class="text-lg font-semibold text-foreground">
                {{ $productId ? 'Edit Product' : 'Add New Product' }}
            </h3>
        </div>

        <form wire:submit="save" class="space-y-6">
            <!-- Title -->
            <flux:input 
                wire:model="title"
                label="Product Title"
                placeholder="e.g., Peanut Butter"
                required
            />

            <!-- Description -->
            <flux:textarea 
                wire:model="description"
                label="Description"
                placeholder="Describe your product"
                rows="4"
                required
            />

            <!-- Image Upload (Optional) -->
            <div>
                <flux:label>Product Image (Optional)</flux:label>
                <p class="text-xs text-muted-foreground mb-2">Images will be optimized to 800x600px WebP format</p>
                <x-ui.file-upload
                    wireModel="image"
                    :existingImage="$existing_image"
                    accept="image/*"
                    maxSize="2048"
                    placeholder="Upload product image (optional)"
                />
            </div>

            <!-- Order -->
            <flux:input 
                wire:model="order"
                type="number"
                label="Display Order"
                placeholder="0"
                min="0"
                required
            />

            <!-- Active Status -->
            <flux:checkbox 
                wire:model="is_active"
                label="Active (Show on website)"
            />

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-border">
                <flux:modal.close>
                    <flux:button variant="filled">Cancel</flux:button>
                </flux:modal.close>
                <flux:button 
                    type="submit" 
                    variant="primary"
                >
                    <span wire:loading.remove wire:target="save">
                        {{ $productId ? 'Update Product' : 'Add Product' }}
                    </span>
                    <span wire:loading wire:target="save">
                        {{ $productId ? 'Updating...' : 'Adding...' }}
                    </span>
                </flux:button>
            </div>
        </form>
    </div>
</flux:modal>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('create-product', () => {
            window.Flux.modal('product-form').show();
        });

        Livewire.on('edit-product', () => {
            window.Flux.modal('product-form').show();
        });

        Livewire.on('product-saved', () => {
            window.Flux.modal('product-form').close();
        });
    });
</script>
