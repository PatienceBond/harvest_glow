<div>
    <!-- Page Header -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Categories</h1>
            <p class="mt-2 text-muted-foreground">
                Organize your posts with categories and tags.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <button wire:click="create" 
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                New Category
            </button>
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
                                <div class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $category->color }};"></div>
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
                                    <button wire:click="edit({{ $category->id }})" 
                                            class="text-primary hover:text-primary/80 transition-colors">
                                        <x-heroicon-o-pencil class="w-4 h-4" />
                                    </button>
                                    <button wire:click="delete({{ $category->id }})" 
                                            wire:confirm="Are you sure you want to delete this category?"
                                            class="text-destructive hover:text-destructive/80 transition-colors">
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
            <h3 class="mt-2 text-sm font-medium text-foreground">No categories yet</h3>
            <p class="mt-1 text-sm text-muted-foreground">Get started by creating your first category.</p>
            <div class="mt-6">
                <button wire:click="create" 
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                    New Category
                </button>
            </div>
        </div>
    @endif

    <!-- Create/Edit Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-background/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-card border border-border rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
                <div class="px-6 py-4 border-b border-border">
                    <h3 class="text-lg font-semibold text-foreground">
                        {{ $editing ? 'Edit Category' : 'Create New Category' }}
                    </h3>
                </div>
                
                <form wire:submit="save" class="p-6 space-y-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium mb-2">Name</label>
                        <input type="text" 
                               id="name"
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
                                   wire:model="color"
                                   class="w-12 h-12 border border-border rounded-lg cursor-pointer @error('color') border-destructive @enderror">
                            <div class="flex-1">
                                <input type="text" 
                                       wire:model="color"
                                       class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                       placeholder="#388E3C">
                            </div>
                        </div>
                        @error('color')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preview -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Preview</label>
                        <div class="p-3 border border-border rounded-lg bg-muted/30">
                            <div class="flex items-center">
                                <div class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $color }};"></div>
                                <span class="font-medium" style="color: {{ $color }};">{{ $name ?: 'Category Name' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-3 pt-4">
                        <button type="button" 
                                wire:click="closeModal"
                                class="px-4 py-2 border border-border rounded-md text-sm font-medium text-foreground hover:bg-muted transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                wire:loading.attr="disabled"
                                wire:target="save"
                                class="px-4 py-2 bg-primary text-white rounded-md text-sm font-medium hover:bg-primary/90 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="save">
                                {{ $editing ? 'Update' : 'Create' }} Category
                            </span>
                            <span wire:loading wire:target="save" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ $editing ? 'Updating...' : 'Creating...' }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
