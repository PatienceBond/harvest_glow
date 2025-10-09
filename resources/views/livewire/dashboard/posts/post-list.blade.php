<div>
    <!-- Search and Filters Bar -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8 gap-4">
        <div class="flex-1 flex gap-4 mb-4 sm:mb-0">
            <flux:input 
                wire:model.live.debounce.300ms="term"
                placeholder="Search posts..."
                class="flex-1"
            />
            
            <flux:select 
                wire:model.live="statusFilter"
                placeholder="All Status"
            >
                <option value="">All Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </flux:select>

            <flux:select 
                wire:model.live="categoryFilter"
                placeholder="All Categories"
            >
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </flux:select>
        </div>
      
        <div class="mt-4 sm:mt-0">
            <flux:modal.trigger name="create-post">
                <flux:button variant="primary" icon="plus">New Post</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <!-- Posts Grid -->
    @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($posts as $post)
                <div class="bg-card border border-border rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-zinc-200 dark:bg-zinc-700 flex items-center justify-center">
                            <x-heroicon-o-photo class="w-16 h-16 text-zinc-400" />
                        </div>
                    @endif

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-foreground line-clamp-1">{{ $post->title }}</h3>
                            <flux:badge :color="$post->is_published ? 'green' : 'zinc'" size="sm">
                                {{ $post->is_published ? 'Published' : 'Draft' }}
                            </flux:badge>
                        </div>

                        @if($post->excerpt)
                            <flux:text class="mb-4 line-clamp-2">{{ $post->excerpt }}</flux:text>
                        @endif

                        <div class="flex items-center justify-between mb-4">
                            @if($post->category)
                                <flux:badge size="sm" color="zinc">
                                    {{ $post->category->name }}
                                </flux:badge>
                            @else
                                <span class="text-sm text-muted-foreground">No category</span>
                            @endif
                            
                            <span class="text-xs text-muted-foreground">
                                {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Not published' }}
                            </span>
                        </div>

                        <div class="flex items-center justify-end space-x-2 pt-4 border-t border-border">
                            <flux:modal.trigger wire:click="view({{ $post->id }})" name="view-post">
                                <flux:button 
                                    variant="ghost"
                                    size="sm"
                                    icon="eye"
                                />
                            </flux:modal.trigger>
                            <flux:modal.trigger wire:click="edit({{ $post->id }})" name="create-post">
                                <flux:button 
                                    variant="ghost"
                                    size="sm"
                                    icon="pencil"
                                />
                            </flux:modal.trigger>
                            <flux:button 
                                wire:click="delete({{ $post->id }})"
                                wire:confirm="Are you sure you want to delete this post?"
                                variant="danger"
                                size="sm"
                                icon="trash"
                            />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <x-heroicon-o-document-text class="mx-auto h-12 w-12 text-muted-foreground" />
            <h3 class="mt-2 text-sm font-medium text-foreground">No posts found</h3>
            <p class="mt-1 text-sm text-muted-foreground">
                @if($term || $statusFilter || $categoryFilter)
                    Try adjusting your search or filters.
                @else
                    Get started by creating your first post using the button above.
                @endif
            </p>
        </div>
    @endif

    <!-- Create/Edit Modal -->
    <flux:modal name="create-post" class="md:w-[800px]">
        <livewire:dashboard.posts.create-edit :key="'post-form'" />
    </flux:modal>

    <!-- View Modal -->
    <flux:modal name="view-post" class="md:w-[800px]">
        <livewire:dashboard.posts.view :key="'post-view'" />
    </flux:modal>
</div>
