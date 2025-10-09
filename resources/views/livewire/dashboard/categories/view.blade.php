<div>
    <div class="px-6 py-4 border-b border-border flex items-center justify-between">
        <h3 class="text-lg font-semibold text-foreground">Category Details</h3>
        <flux:button wire:click="close" variant="ghost" size="sm" icon="x-mark" square />
    </div>

    <div class="p-6 space-y-6">
        <!-- Category Name with Color -->
        <flux:field>
            <flux:label>Name</flux:label>
            <div class="flex items-center">
                <div class="w-6 h-6 rounded-full mr-3" style="background-color: {{ $category->color }}"></div>
                <span class="text-xl font-semibold text-foreground">{{ $category->name }}</span>
            </div>
        </flux:field>

        <!-- Slug -->
        <flux:field>
            <flux:label>Slug</flux:label>
            <flux:text class="font-mono text-sm bg-muted/30 px-3 py-2 rounded inline-block">{{ $category->slug }}</flux:text>
        </flux:field>

        <!-- Description -->
        @if($category->description)
            <flux:field>
                <flux:label>Description</flux:label>
                <flux:text>{{ $category->description }}</flux:text>
            </flux:field>
        @endif

        <!-- Color -->
        <flux:field>
            <flux:label>Color</flux:label>
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-lg border border-border" style="background-color: {{ $category->color }}"></div>
                <flux:text class="font-mono">{{ $category->color }}</flux:text>
            </div>
        </flux:field>

        <!-- Stats -->
        <flux:field>
            <flux:label>Statistics</flux:label>
            <div class="bg-muted/30 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-muted-foreground">Total Posts</span>
                    <flux:badge size="lg" color="zinc">{{ $category->posts_count }}</flux:badge>
                </div>
            </div>
        </flux:field>

        <!-- Meta Information -->
        <div class="pt-4 border-t border-border space-y-2">
            <div class="flex justify-between text-sm">
                <flux:text>Created</flux:text>
                <flux:text>{{ $category->created_at->format('M j, Y g:i A') }}</flux:text>
            </div>
            <div class="flex justify-between text-sm">
                <flux:text>Last Updated</flux:text>
                <flux:text>{{ $category->updated_at->format('M j, Y g:i A') }}</flux:text>
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