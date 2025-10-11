<div>
    <!-- Search and Actions -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="flex-1">
            <flux:input 
                wire:model.live.debounce.300ms="term"
                placeholder="Search products..."
                icon="magnifying-glass"
            />
        </div>
        <flux:button wire:click="create" variant="primary" icon="plus">
            Add Product
        </flux:button>
    </div>

    <!-- Products Table -->
    <div class="bg-card border border-border rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted/30 border-b border-border">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Description
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Order
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($products as $product)
                        <tr class="hover:bg-muted/20 transition-colors">
                            <td class="px-6 py-4">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->title }}"
                                         class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <div class="w-16 h-16 bg-muted rounded-lg flex items-center justify-center">
                                        <x-heroicon-o-photo class="w-8 h-8 text-muted-foreground" />
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium">{{ $product->title }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-muted-foreground line-clamp-2">
                                    {{ $product->description }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge>{{ $product->order }}</flux:badge>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge :color="$product->is_active ? 'green' : 'red'">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </flux:badge>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <flux:button 
                                    wire:click="toggleActive({{ $product->id }})"
                                    variant="ghost" 
                                    size="sm"
                                    icon="{{ $product->is_active ? 'eye-slash' : 'eye' }}"
                                />
                                <flux:button 
                                    wire:click="edit({{ $product->id }})"
                                    variant="ghost" 
                                    size="sm"
                                    icon="pencil"
                                />
                                <flux:button 
                                    wire:click="delete({{ $product->id }})"
                                    wire:confirm="Are you sure you want to delete this product?"
                                    variant="ghost" 
                                    size="sm"
                                    icon="trash"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-muted-foreground">
                                <div class="flex flex-col items-center">
                                    <x-heroicon-o-cube class="w-12 h-12 mb-3 text-muted-foreground/50" />
                                    <p>No products found.</p>
                                    <flux:button wire:click="create" variant="primary" size="sm" class="mt-3">
                                        Add Your First Product
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
