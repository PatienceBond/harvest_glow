<div>
    <!-- Search Bar -->
    <div class="mb-6">
        <input type="text"
               wire:model.live.debounce.300ms="search"
               placeholder="Search categories..."
               class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>

    <!-- Categories Grid -->
    @if($categories->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <div class="bg-card border border-border rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <div class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $category->color }}"></div>
                                <h3 class="text-lg font-semibold text-foreground">{{ $category->name }}</h3>
                            </div>

                            @if($category->description)
                                <p class="text-sm text-muted-foreground mb-4">{{ $category->description }}</p>
                            @endif

                            <div class="flex items-center justify-between">
                                <span class="text-sm text-muted-foreground">
                                    {{ $category->posts_count }} {{ Str::plural('post', $category->posts_count) }}
                                </span>
                                <div class="flex items-center space-x-2">
                                    <button wire:click="$dispatch('view-category', { categoryId: {{ $category->id }} })"
                                            class="text-foreground hover:text-primary transition-colors"
                                            title="View">
                                        <x-heroicon-o-eye class="w-4 h-4" />
                                    </button>
                                    <button wire:click="$dispatch('edit-category', { categoryId: {{ $category->id }} })"
                                            class="text-primary hover:text-primary/80 transition-colors"
                                            title="Edit">
                                        <x-heroicon-o-pencil class="w-4 h-4" />
                                    </button>
                                    <button wire:click="delete({{ $category->id }})"
                                            wire:confirm="Are you sure you want to delete this category?"
                                            class="text-destructive hover:text-destructive/80 transition-colors"
                                            title="Delete">
                                        <x-heroicon-o-trash class="w-4 h-4" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <x-heroicon-o-tag class="mx-auto h-12 w-12 text-muted-foreground" />
            <h3 class="mt-2 text-sm font-medium text-foreground">No categories found</h3>
            <p class="mt-1 text-sm text-muted-foreground">
                @if($search)
                    Try adjusting your search criteria.
                @else
                    Get started by creating your first category.
                @endif
            </p>
            @if(!$search)
                <div class="mt-6">
                    <button wire:click="$dispatch('openCreate', {}, 'dashboard.categories.index')"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                        New Category
                    </button>
                </div>
            @endif
        </div>
    @endif
</div>
