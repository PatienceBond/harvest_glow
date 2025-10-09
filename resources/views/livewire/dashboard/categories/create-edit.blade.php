<div x-data="{ localName: @entangle('name'), localColor: @entangle('color') }">
    <div class="py-4">
        <h3 class="text-lg font-semibold text-foreground">
            {{ $categoryId ? 'Edit Category' : 'Create New Category' }}
        </h3>
    </div>

    <form wire:submit="save" class="space-y-6">
        <!-- Name -->
        <flux:input 
            x-model="localName"
            wire:model="name"
            label="Name"
            placeholder="Category name"
        />

        <!-- Description -->
        <flux:textarea 
            wire:model="description"
            label="Description"
            rows="3"
            placeholder="Optional description"
        />

        <!-- Color -->
        <flux:field>
            <flux:label>Color</flux:label>
            <div class="flex items-center space-x-4">
                <input type="color"
                       id="color"
                       x-model="localColor"
                       wire:model="color"
                       class="w-12 h-12 border border-border rounded-lg cursor-pointer">
                <div class="flex-1">
                    <flux:input 
                        x-model="localColor"
                        wire:model.blur="color"
                        placeholder="#388E3C"
                    />
                </div>
            </div>
            <flux:error name="color" />
        </flux:field>

        <!-- Preview - Using Alpine for instant preview -->
        <flux:field>
            <flux:label>Preview</flux:label>
            <div class="p-3 border border-border rounded-lg bg-muted/30">
                <div class="flex items-center">
                    <div class="w-4 h-4 rounded-full mr-3" :style="`background-color: ${localColor}`"></div>
                    <span class="font-medium" :style="`color: ${localColor}`" x-text="localName || 'Category Name'"></span>
                </div>
            </div>
        </flux:field>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-border">
            <flux:modal.close>
                <flux:button variant="filled">Cancel</flux:button>
            </flux:modal.close>
            <flux:button 
                type="submit" 
                variant="primary" 
                wire:click="save"
            >
                <span wire:loading.remove wire:target="save">
                    {{ $categoryId ? 'Update' : 'Create' }} Category
                </span>
                <span wire:loading wire:target="save">
                    {{ $categoryId ? 'Updating...' : 'Creating...' }}
                </span>
            </flux:button>
        </div>
    </form>
</div>