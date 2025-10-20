<div>
    <div class="py-4">
        <h3 class="text-lg font-semibold text-foreground">
            {{ $postId ? 'Edit Post' : 'Create New Post' }}
        </h3>
    </div>

    <form wire:submit="save" class="space-y-6">
        <!-- Title -->
        <flux:input 
            wire:model="title"
            label="Title"
            placeholder="Post title"
        />

        <flux:textarea class="{{ $postId ? '' : 'hidden' }}"
            wire:model="excerpt"
            label=""
            rows="2"
            placeholder="Brief description (optional)"
        />

        <!-- Content -->
        <flux:textarea 
            wire:model="content"
            label="Content"
            rows="10"
            placeholder="Write your post content here..."
        />

        <!-- Featured Image -->
        <x-ui.post-image-upload 
            wire-model="featured_image"
            :existing-image="$existing_featured_image"
            label="Featured Image"
            help-text="Upload a featured image for your post (Max 2MB, JPG, PNG, WEBP)"
        />

        <!-- Category -->
        <flux:select 
            wire:model="category_id"
            label="Category"
            placeholder="Select a category (optional)"
        >
            <option value="">No category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </flux:select>

        <!-- Published Status -->
        <div class="flex items-center space-x-4">
            <flux:checkbox 
                wire:model.live="is_published"
                label="Published"
            />
            
            @if($is_published)
                <flux:input 
                    wire:model="published_at"
                    type="datetime-local"
                    label="Publish Date"
                    class="flex-1"
                />
            @endif
        </div>

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
                    {{ $postId ? 'Update' : ($is_published ? 'Publish' : 'Save Draft') }}
                </span>
                <span wire:loading wire:target="save">
                    {{ $postId ? 'Updating...' : 'Saving...' }}
                </span>
            </flux:button>
        </div>
    </form>
</div>
