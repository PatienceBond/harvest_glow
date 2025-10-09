<div class="">
    <!-- Header -->
    <div class=" py-4">
        <h3 class="text-lg font-semibold text-foreground">Category Details</h3>
    </div>

    <div class=" space-y-6">
        <!-- Name & Color -->
        <div class="flex items-center space-x-4">
         
            <div>
                <h2 class="text-xl font-semibold text-foreground">{{ $category->name }}</h2>
                <p class="text-sm text-muted-foreground">{{ $category->slug }}</p>
            </div>
        </div>

        <!-- Description -->
        @if($category->description)
            <p class="text-foreground leading-relaxed">{{ $category->description }}</p>
        @endif

        <!-- Color Code -->
        <div class="flex space-x-2 items-center">
            <div class="w-8 h-8 rounded-lg border border-border" style="background-color: {{ $category->color }}"></div>
            <span class="font-mono text-sm text-foreground">{{ $category->color }}</span>
        </div>

        <!-- Statistics -->
        <div class=" flex space-x-2 items-center">
            <flux:badge size="lg" color="zinc">{{ $category->posts_count }}</flux:badge>
            <span class="text-sm text-muted-foreground">Total Posts</span>
        </div>



        <!-- Actions -->
        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-border">
            <flux:modal.close>
                <flux:button variant="ghost">Close</flux:button>
            </flux:modal.close>
            <flux:modal.trigger name="edit-category{{ $category->id }}">
                <flux:button variant="primary" icon="pencil">
                    Edit Category
                </flux:button>
            </flux:modal.trigger>
        </div>
    </div>
</div>
