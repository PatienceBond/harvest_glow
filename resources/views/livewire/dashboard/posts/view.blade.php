<div class="">
    <!-- Header -->
    <div class="py-4">
        <h3 class="text-lg font-semibold text-foreground">Post Details</h3>
    </div>

    @if($post)
        <div class="space-y-6">
            <!-- Featured Image -->
            @if($post->featured_image)
                <div class="rounded-lg overflow-hidden border border-border">
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
                </div>
            @endif

            <!-- Title & Status -->
            <div>
                <div class="flex items-start justify-between mb-2">
                    <h2 class="text-2xl font-bold text-foreground flex-1">{{ $post->title }}</h2>
                    <flux:badge :color="$post->is_published ? 'green' : 'zinc'">
                        {{ $post->is_published ? 'Published' : 'Draft' }}
                    </flux:badge>
                </div>
                <p class="text-sm text-muted-foreground">{{ $post->slug }}</p>
            </div>

            @if($post->excerpt)
                <div>
                    <p class="text-foreground leading-relaxed">{{ $post->excerpt }}</p>
                </div>
            @endif

            <!-- Content -->
            <div>
                <h4 class="text-sm font-semibold text-foreground mb-2">Content</h4>
                <div class="text-foreground leading-relaxed prose prose-sm dark:prose-invert max-w-none">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            <!-- Metadata -->
            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-border">
                <div>
                    <h4 class="text-sm font-semibold text-foreground mb-1">Category</h4>
                    @if($post->category)
                        <flux:badge size="sm" color="zinc">{{ $post->category->name }}</flux:badge>
                    @else
                        <span class="text-sm text-muted-foreground">No category</span>
                    @endif
                </div>

                <div>
                    <h4 class="text-sm font-semibold text-foreground mb-1">Author</h4>
                    <span class="text-sm text-foreground">{{ $post->user->name }}</span>
                </div>

                <div>
                    <h4 class="text-sm font-semibold text-foreground mb-1">Published Date</h4>
                    <span class="text-sm text-foreground">
                        {{ $post->published_at ? $post->published_at->format('F d, Y h:i A') : 'Not published' }}
                    </span>
                </div>

                <div>
                    <h4 class="text-sm font-semibold text-foreground mb-1">Last Updated</h4>
                    <span class="text-sm text-foreground">{{ $post->updated_at->format('F d, Y h:i A') }}</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-border">
                <flux:modal.close>
                    <flux:button variant="ghost">Close</flux:button>
                </flux:modal.close>
                <flux:button wire:click="$dispatch('edit-post', { postId: {{ $post->id }} })" variant="primary" icon="pencil">
                    Edit Post
                </flux:button>
            </div>
        </div>
    @else
        <div class="py-8 text-center">
            <p class="text-muted-foreground">Loading post details...</p>
        </div>
    @endif
</div>
