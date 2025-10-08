<div x-data="{ localName: @entangle('name'), localColor: @entangle('color') }">
    <div class="px-6 py-4 border-b border-border">
        <h3 class="text-lg font-semibold text-foreground">
            {{ $categoryId ? 'Edit Category' : 'Create New Category' }}
        </h3>
    </div>

    <form wire:submit="save" class="p-6 space-y-4">
        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium mb-2">Name</label>
            <input type="text"
                   id="name"
                   x-model="localName"
                   wire:model="name"
                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-destructive @enderror"
                   placeholder="Category name">
            @error('name')
                <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium mb-2">Description</label>
            <textarea id="description"
                      wire:model="description"
                      rows="3"
                      class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('description') border-destructive @enderror"
                      placeholder="Optional description"></textarea>
            @error('description')
                <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
            @enderror
        </div>

        <!-- Color -->
        <div>
            <label for="color" class="block text-sm font-medium mb-2">Color</label>
            <div class="flex items-center space-x-4">
                <input type="color"
                       id="color"
                       x-model="localColor"
                       wire:model="color"
                       class="w-12 h-12 border border-border rounded-lg cursor-pointer @error('color') border-destructive @enderror">
                <div class="flex-1">
                    <input type="text"
                           x-model="localColor"
                           wire:model.blur="color"
                           class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                           placeholder="#388E3C">
                </div>
            </div>
            @error('color')
                <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
            @enderror
        </div>

        <!-- Preview - Using Alpine for instant preview -->
        <div>
            <label class="block text-sm font-medium mb-2">Preview</label>
            <div class="p-3 border border-border rounded-lg bg-muted/30">
                <div class="flex items-center">
                    <div class="w-4 h-4 rounded-full mr-3" :style="`background-color: ${localColor}`"></div>
                    <span class="font-medium" :style="`color: ${localColor}`" x-text="localName || 'Category Name'"></span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-3 pt-4">
            <button type="button"
                    wire:click="cancel"
                    class="px-4 py-2 border border-border rounded-md text-sm font-medium text-foreground hover:bg-muted transition-colors">
                Cancel
            </button>
            <button type="submit"
                    wire:loading.attr="disabled"
                    wire:target="save"
                    class="px-4 py-2 bg-primary text-white rounded-md text-sm font-medium hover:bg-primary/90 disabled:opacity-50 transition-colors">
                <span wire:loading.remove wire:target="save">{{ $categoryId ? 'Update' : 'Create' }} Category</span>
                <span wire:loading wire:target="save">{{ $categoryId ? 'Updating...' : 'Creating...' }}</span>
            </button>
        </div>
    </form>
</div>