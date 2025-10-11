<div>
    <!-- Actions -->
    <div class="flex justify-end mb-6">
        <flux:button wire:click="create" variant="primary" icon="plus">
            Add Hero Section
        </flux:button>
    </div>

    <!-- Hero Sections Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($heroes as $hero)
            <div class="bg-card border border-border rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                <!-- Hero Image Preview -->
                @if($hero->image)
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ Storage::url($hero->image) }}" 
                             alt="{{ $hero->heading }}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                            <div class="text-white text-center p-4">
                                <h3 class="font-bold text-lg">{{ $hero->heading }}</h3>
                                @if($hero->subheading)
                                    <p class="text-sm mt-1">{{ Str::limit($hero->subheading, 50) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="h-48 bg-muted flex items-center justify-center">
                        <x-heroicon-o-photo class="w-16 h-16 text-muted-foreground" />
                    </div>
                @endif

                <!-- Hero Details -->
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <flux:badge variant="filled">{{ ucfirst($hero->page) }}</flux:badge>
                        <flux:badge :color="$hero->is_active ? 'green' : 'red'">
                            {{ $hero->is_active ? 'Active' : 'Inactive' }}
                        </flux:badge>
                    </div>
                    
                    <h4 class="font-bold mb-2">{{ $hero->heading }}</h4>
                    @if($hero->subheading)
                        <p class="text-sm text-muted-foreground mb-3">{{ Str::limit($hero->subheading, 80) }}</p>
                    @endif
                    
                    <div class="text-xs text-muted-foreground mb-4">
                        Height: {{ $hero->height }}
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 border-t border-border pt-4">
                        <flux:button 
                            wire:click="toggleActive({{ $hero->id }})"
                            variant="ghost" 
                            size="sm"
                            icon="{{ $hero->is_active ? 'eye-slash' : 'eye' }}"
                            class="flex-1"
                        >
                            {{ $hero->is_active ? 'Deactivate' : 'Activate' }}
                        </flux:button>
                        <flux:button 
                            wire:click="edit({{ $hero->id }})"
                            variant="ghost" 
                            size="sm"
                            icon="pencil"
                        />
                        <flux:button 
                            wire:click="delete({{ $hero->id }})"
                            wire:confirm="Are you sure you want to delete this hero section?"
                            variant="ghost" 
                            size="sm"
                            icon="trash"
                        />
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-card border border-border rounded-lg p-12 text-center">
                    <x-heroicon-o-photo class="w-16 h-16 mx-auto mb-4 text-muted-foreground/50" />
                    <p class="text-muted-foreground mb-4">No hero sections found.</p>
                    <flux:button wire:click="create" variant="primary">
                        Add Your First Hero Section
                    </flux:button>
                </div>
            </div>
        @endforelse
    </div>
</div>

