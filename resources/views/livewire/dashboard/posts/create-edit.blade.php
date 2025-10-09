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

        <!-- Excerpt -->
        <flux:textarea 
            wire:model="excerpt"
            label="Excerpt"
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
        <flux:field>
            <flux:label>Featured Image</flux:label>
            
            @if($existing_featured_image && !$featured_image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $existing_featured_image) }}" alt="Current image" class="w-48 h-32 object-cover rounded-lg border border-border">
                    <flux:button 
                        wire:click="removeExistingImage"
                        variant="ghost"
                        size="sm"
                        type="button"
                        class="mt-2"
                    >
                        Remove existing image
                    </flux:button>
                </div>
            @endif

            <input 
                type="file" 
                wire:model="featured_image"
                accept="image/*"
                class="w-full border border-border rounded-lg p-2"
            />
            
            @if($featured_image)
                <div class="mt-3 flex items-center gap-2">
                    <span class="text-sm text-muted-foreground">New image selected</span>
                    <flux:button 
                        wire:click="removeFile"
                        variant="ghost"
                        size="sm"
                        type="button"
                    >
                        Remove
                    </flux:button>
                </div>
            @endif

            <flux:error name="featured_image" />
            
            <div wire:loading wire:target="featured_image" class="mt-2 text-sm text-muted-foreground">
                Uploading...
            </div>
        </flux:field>

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
