<div>
    <!-- Page Header -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Impact Metrics</h1>
            <p class="mt-2 text-muted-foreground">
                Track and manage your organization's impact metrics and achievements.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <button wire:click="create" 
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                New Metric
            </button>
        </div>
    </div>

    <!-- Featured Metrics -->
    @if($featuredMetrics->count() > 0)
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Featured Metrics</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredMetrics as $metric)
                    <div class="bg-card border border-border rounded-lg p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-lg flex items-center justify-center" 
                                 style="background-color: {{ $metric->color }}20">
                                @if($metric->icon)
                                    @if(str_starts_with($metric->icon, 'storage/') || str_starts_with($metric->icon, 'metrics/'))
                                        <img src="{{ asset('storage/' . $metric->icon) }}" alt="Icon" class="w-8 h-8 object-contain">
                                    @else
                                        <span class="text-2xl">{{ $metric->icon }}</span>
                                    @endif
                                @else
                                    <x-heroicon-o-chart-bar class="w-6 h-6" style="color: {{ $metric->color }};" />
                                @endif
                            </div>
                            <div class="flex items-center space-x-2">
                                <button wire:click="edit({{ $metric->id }})" 
                                        class="text-primary hover:text-primary/80 transition-colors">
                                    <x-heroicon-o-pencil class="w-4 h-4" />
                                </button>
                                <button wire:click="delete({{ $metric->id }})" 
                                        wire:confirm="Are you sure you want to delete this metric?"
                                        class="text-destructive hover:text-destructive/80 transition-colors">
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-foreground mb-2">{{ $metric->title }}</h3>
                        <div class="text-3xl font-bold mb-2" style="color: {{ $metric->color }};">
                            {{ $metric->value }}
                            @if($metric->unit)
                                <span class="text-lg font-normal text-muted-foreground">{{ $metric->unit }}</span>
                            @endif
                        </div>
                        @if($metric->description)
                            <p class="text-sm text-muted-foreground">{{ $metric->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- All Metrics -->
    <div>
        <h2 class="text-xl font-semibold mb-4">All Metrics</h2>
        @if($metrics->count() > 0)
            <div class="bg-card border border-border rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-border">
                        <thead class="bg-muted/30">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                    Metric
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                    Value
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                    Featured
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                    Sort Order
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            @foreach($metrics as $metric)
                                <tr class="hover:bg-muted/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                @if($metric->icon)
                                                    @if(str_starts_with($metric->icon, 'storage/') || str_starts_with($metric->icon, 'metrics/'))
                                                        <img src="{{ asset('storage/' . $metric->icon) }}" alt="Icon" class="w-8 h-8 object-contain">
                                                    @else
                                                        <span class="text-2xl">{{ $metric->icon }}</span>
                                                    @endif
                                                @else
                                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" 
                                                         style="background-color: {{ $metric->color }}20">
                                                        <x-heroicon-o-chart-bar class="w-4 h-4" style="color: {{ $metric->color }};" />
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-foreground">
                                                    {{ $metric->title }}
                                                </div>
                                                @if($metric->description)
                                                    <div class="text-sm text-muted-foreground">
                                                        {{ Str::limit($metric->description, 60) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-foreground">
                                            {{ $metric->value }}
                                            @if($metric->unit)
                                                <span class="text-muted-foreground">{{ $metric->unit }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($metric->is_featured)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                <x-heroicon-o-star class="w-3 h-3 mr-1" />
                                                Featured
                                            </span>
                                        @else
                                            <span class="text-sm text-muted-foreground">No</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                                        {{ $metric->sort_order }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <button wire:click="edit({{ $metric->id }})" 
                                                    class="text-primary hover:text-primary/80 transition-colors">
                                                <x-heroicon-o-pencil class="w-4 h-4" />
                                            </button>
                                            <button wire:click="delete({{ $metric->id }})" 
                                                    wire:confirm="Are you sure you want to delete this metric?"
                                                    class="text-destructive hover:text-destructive/80 transition-colors">
                                                <x-heroicon-o-trash class="w-4 h-4" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <x-heroicon-o-chart-bar class="mx-auto h-12 w-12 text-muted-foreground" />
                <h3 class="mt-2 text-sm font-medium text-foreground">No metrics yet</h3>
                <p class="mt-1 text-sm text-muted-foreground">Get started by creating your first impact metric.</p>
                <div class="mt-6">
                    <button wire:click="create" 
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                        New Metric
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Create/Edit Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-background/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-card border border-border rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
                <div class="px-6 py-4 border-b border-border">
                    <h3 class="text-lg font-semibold text-foreground">
                        {{ $editing ? 'Edit Metric' : 'Create New Metric' }}
                    </h3>
                </div>
                
                <form wire:submit="save" class="p-6 space-y-4">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium mb-2">Title</label>
                        <input type="text" 
                               id="title"
                               wire:model="title"
                               class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('title') border-destructive @enderror"
                               placeholder="e.g., Farmers Reached">
                        @error('title')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Value -->
                    <div>
                        <label for="value" class="block text-sm font-medium mb-2">Value</label>
                        <input type="text" 
                               id="value"
                               wire:model="value"
                               class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('value') border-destructive @enderror"
                               placeholder="e.g., 100,000">
                        @error('value')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Unit -->
                    <div>
                        <label for="unit" class="block text-sm font-medium mb-2">Unit</label>
                        <input type="text" 
                               id="unit"
                               wire:model="unit"
                               class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('unit') border-destructive @enderror"
                               placeholder="e.g., farmers, communities, tons">
                        @error('unit')
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
                                  placeholder="Brief description of the metric"></textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Icon -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Icon</label>
                        <div class="space-y-4">
                            <!-- Emoji Input -->
                            <div>
                                <label for="icon_emoji" class="block text-sm font-medium mb-2">Emoji (optional)</label>
                                <input type="text" 
                                       id="icon_emoji"
                                       wire:model="icon_emoji"
                                       class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                       placeholder="🌱">
                            </div>
                            
                            <!-- Image Upload -->
                            <div>
                                <label class="block text-sm font-medium mb-2">Or Upload Icon Image</label>
                                <x-ui.file-upload 
                                    wireModel="icon_image"
                                    accept="image/*"
                                    maxSize="512"
                                    placeholder="Upload icon image"
                                />
                            </div>
                        </div>
                        @error('icon_emoji')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                        @error('icon_image')
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

                    <!-- Featured -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   wire:model="is_featured"
                                   class="rounded border-border text-primary focus:ring-primary">
                            <span class="ml-2 text-sm font-medium">Featured metric</span>
                        </label>
                        <p class="mt-1 text-xs text-muted-foreground">
                            Featured metrics will be displayed prominently on the impact page.
                        </p>
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-sm font-medium mb-2">Sort Order</label>
                        <input type="number" 
                               id="sort_order"
                               wire:model="sort_order"
                               class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('sort_order') border-destructive @enderror"
                               placeholder="0">
                        @error('sort_order')
                            <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preview -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Preview</label>
                        <div class="p-4 border border-border rounded-lg bg-muted/30">
                            <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-lg flex items-center justify-center" 
                                 style="background-color: {{ $color }}20">
                                @if($icon_emoji || $icon_image)
                                    @if($icon_image)
                                        <img src="{{ $icon_image->temporaryUrl() }}" alt="Icon" class="w-8 h-8 object-contain">
                                    @elseif($icon_emoji)
                                        <span class="text-2xl">{{ $icon_emoji }}</span>
                                    @endif
                                @else
                                    <x-heroicon-o-chart-bar class="w-6 h-6" style="color: {{ $color }};" />
                                @endif
                            </div>
                                @if($is_featured)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        <x-heroicon-o-star class="w-3 h-3 mr-1" />
                                        Featured
                                    </span>
                                @endif
                            </div>
                            <h3 class="text-lg font-semibold text-foreground mb-2">{{ $title ?: 'Metric Title' }}</h3>
                            <div class="text-3xl font-bold mb-2" style="color: {{ $color }};">
                                {{ $value ?: '0' }}
                                @if($unit)
                                    <span class="text-lg font-normal text-muted-foreground">{{ $unit }}</span>
                                @endif
                            </div>
                            @if($description)
                                <p class="text-sm text-muted-foreground">{{ $description }}</p>
                            @endif
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
                                {{ $editing ? 'Update' : 'Create' }} Metric
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
