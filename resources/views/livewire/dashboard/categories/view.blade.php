<div>
    <div class="px-6 py-4 border-b border-border flex items-center justify-between">
        <h3 class="text-lg font-semibold text-foreground">Category Details</h3>
        <button wire:click="close" class="text-muted-foreground hover:text-foreground">
            <x-heroicon-o-x-mark class="w-5 h-5" />
        </button>
    </div>

    <div class="p-6 space-y-6">
        <!-- Category Name with Color -->
        <div>
            <label class="block text-sm font-medium text-muted-foreground mb-2">Name</label>
            <div class="flex items-center">
                <div class="w-6 h-6 rounded-full mr-3" style="background-color: {{ $category->color }}"></div>
                <span class="text-xl font-semibold text-foreground">{{ $category->name }}</span>
            </div>
        </div>

        <!-- Slug -->
        <div>
            <label class="block text-sm font-medium text-muted-foreground mb-2">Slug</label>
            <p class="text-foreground font-mono text-sm bg-muted/30 px-3 py-2 rounded">{{ $category->slug }}</p>
        </div>

        <!-- Description -->
        @if($category->description)
            <div>
                <label class="block text-sm font-medium text-muted-foreground mb-2">Description</label>
                <p class="text-foreground">{{ $category->description }}</p>
            </div>
        @endif

        <!-- Color -->
        <div>
            <label class="block text-sm font-medium text-muted-foreground mb-2">Color</label>
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-lg border border-border" style="background-color: {{ $category->color }}"></div>
                <span class="text-foreground font-mono">{{ $category->color }}</span>
            </div>
        </div>

        <!-- Stats -->
        <div>
            <label class="block text-sm font-medium text-muted-foreground mb-2">Statistics</label>
            <div class="bg-muted/30 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-muted-foreground">Total Posts</span>
                    <span class="text-lg font-semibold text-foreground">{{ $category->posts_count }}</span>
                </div>
            </div>
        </div>

        <!-- Meta Information -->
        <div class="pt-4 border-t border-border space-y-2">
            <div class="flex justify-between text-sm">
                <span class="text-muted-foreground">Created</span>
                <span class="text-foreground">{{ $category->created_at->format('M j, Y g:i A') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-muted-foreground">Last Updated</span>
                <span class="text-foreground">{{ $category->updated_at->format('M j, Y g:i A') }}</span>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-border">
            <flux:modal.close>
                <flux:button variant="ghost">Close</flux:button>
            </flux:modal.close>
            <flux:modal.trigger name="create-category">
                <flux:button variant="primary" wire:click="edit" icon="pencil">
                    Edit Category
                </flux:button>
            </flux:modal.trigger>
        </div>
    </div>
</div>
