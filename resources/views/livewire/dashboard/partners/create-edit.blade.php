<flux:modal name="partner-form" class="min-w-[600px]">
    <div>
        <div class="py-4">
            <h3 class="text-lg font-semibold text-foreground">
                {{ $partnerId ? 'Edit Partner' : 'Add New Partner' }}
            </h3>
        </div>

        <form wire:submit="save" class="space-y-6">
            <!-- Name -->
            <flux:input 
                wire:model="name"
                label="Partner Name"
                placeholder="e.g., MasterCard Foundation"
                required
            />

            <!-- Description -->
            <flux:textarea 
                wire:model="description"
                label="Description"
                placeholder="Describe the partner organization"
                rows="4"
                required
            />

            <!-- Website -->
            <flux:input 
                wire:model="website"
                type="url"
                label="Website (Optional)"
                placeholder="https://example.com"
            />

            <!-- Category -->
            <flux:select wire:model="category" label="Category" required>
                <option value="Strategic Partner">Strategic Partner</option>
                <option value="Research Partner">Research Partner</option>
                <option value="Implementation Partner">Implementation Partner</option>
            </flux:select>

            <!-- Logo Upload (Optional) -->
            <div>
                <flux:label>Partner Logo (Optional)</flux:label>
                <p class="text-xs text-muted-foreground mb-2">Logos will be optimized to 400x400px WebP format</p>
                <x-ui.file-upload
                    wireModel="logo"
                    :existingImage="$existing_logo"
                    accept="image/*"
                    maxSize="2048"
                    placeholder="Upload partner logo (optional)"
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
                        {{ $partnerId ? 'Update Partner' : 'Add Partner' }}
                    </span>
                    <span wire:loading wire:target="save">
                        {{ $partnerId ? 'Updating...' : 'Adding...' }}
                    </span>
                </flux:button>
            </div>
        </form>
    </div>
</flux:modal>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('create-partner', () => {
            window.Flux.modal('partner-form').show();
        });

        Livewire.on('edit-partner', () => {
            window.Flux.modal('partner-form').show();
        });

        Livewire.on('partner-saved', () => {
            window.Flux.modal('partner-form').close();
        });
    });
</script>

