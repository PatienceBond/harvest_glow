<div>
    <!-- Search Bar -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div class="mb-6">
            <flux:input 
                wire:model.live.debounce.300ms="search"
                placeholder="Search categories..."
                icon="magnifying-glass"
            />
        </div>
      
        <div class="mt-4 sm:mt-0">
            <flux:modal.trigger name="create-category">
                <flux:button variant="primary" icon="plus">New Category</flux:button>
            </flux:modal.trigger>
        </div>
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
                                <flux:text class="mb-4">{{ $category->description }}</flux:text>
                            @endif

                            <div class="flex items-center justify-between">
                                <flux:badge size="sm" color="zinc">
                                    {{ $category->posts_count }} {{ Str::plural('post', $category->posts_count) }}
                                </flux:badge>
                                <div class="flex items-center space-x-2">
                                    <flux:modal.trigger name="view-category{{ $category->id }}">
                                        <flux:button 
                                            wire:click="$dispatch('view-category', { categoryId: {{ $category->id }} })"
                                            variant="ghost"
                                            size="sm"
                                            icon="eye"
                                        />
                                    </flux:modal.trigger>
                                    <flux:modal.trigger name="edit-category{{ $category->id }}">
                                        <flux:button 
                                            wire:click="$dispatch('edit-category', { categoryId: {{ $category->id }} })"
                                            variant="ghost"
                                            size="sm"
                                            icon="pencil"
                                        />
                                    </flux:modal.trigger>
                                    <flux:button 
                                        wire:click="delete({{ $category->id }})"
                                        wire:confirm="Are you sure you want to delete this category?"
                                        variant="danger"
                                        size="sm"
                                        icon="trash"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal -->
                    <flux:modal name="edit-category{{ $category->id }}" class="md:w-96">
                    <livewire:dashboard.categories.create-edit  :key="'edit-category-{{ $category->id }}'" :category="$category" />
                    </flux:modal>
                    <!-- End Edit Modal -->
                     <!-- View Modal -->
                       <flux:modal name="view-category{{ $category->id }}" class="md:w-96">
        <livewire:dashboard.categories.view :category="$category" :key="'view-'.$category->id" />
    </flux:modal>
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
                    Get started by creating your first category using the button above.
                @endif
            </p>
        </div>
    @endif

     <!-- Create/Edit Modal - Using Flux Native Modal -->
    <flux:modal name="create-category" class="md:w-96">
        <livewire:dashboard.categories.create-edit  :key="'new'" />
    </flux:modal>
</div>