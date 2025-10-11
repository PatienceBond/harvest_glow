<div>
    <!-- Search and Actions -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="flex-1">
            <flux:input 
                wire:model.live.debounce.300ms="term"
                placeholder="Search partners..."
                icon="magnifying-glass"
            />
        </div>
        <flux:select wire:model.live="categoryFilter" placeholder="All Categories">
            <option value="">All Categories</option>
            <option value="Strategic Partner">Strategic Partner</option>
            <option value="Research Partner">Research Partner</option>
            <option value="Implementation Partner">Implementation Partner</option>
        </flux:select>
        <flux:button wire:click="create" variant="primary" icon="plus">
            Add Partner
        </flux:button>
    </div>

    <!-- Partners Table -->
    <div class="bg-card border border-border rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted/30 border-b border-border">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Logo
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Category
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">
                            Website
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
                    @forelse($partners as $partner)
                        <tr class="hover:bg-muted/20 transition-colors">
                            <td class="px-6 py-4">
                                @if($partner->logo)
                                    <img src="{{ Storage::url($partner->logo) }}" 
                                         alt="{{ $partner->name }}"
                                         class="w-16 h-16 object-contain rounded-lg bg-white p-2">
                                @else
                                    <div class="w-16 h-16 bg-muted rounded-lg flex items-center justify-center">
                                        <x-heroicon-o-building-office-2 class="w-8 h-8 text-muted-foreground" />
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium">{{ $partner->name }}</div>
                                <div class="text-sm text-muted-foreground line-clamp-1">{{ Str::limit($partner->description, 60) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge>{{ $partner->category }}</flux:badge>
                            </td>
                            <td class="px-6 py-4">
                                @if($partner->website)
                                    <a href="{{ $partner->website }}" target="_blank" class="text-primary hover:underline text-sm">
                                        Visit
                                    </a>
                                @else
                                    <span class="text-muted-foreground text-sm">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge>{{ $partner->order }}</flux:badge>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge :color="$partner->is_active ? 'green' : 'red'">
                                    {{ $partner->is_active ? 'Active' : 'Inactive' }}
                                </flux:badge>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <flux:button 
                                    wire:click="toggleActive({{ $partner->id }})"
                                    variant="ghost" 
                                    size="sm"
                                    icon="{{ $partner->is_active ? 'eye-slash' : 'eye' }}"
                                />
                                <flux:button 
                                    wire:click="edit({{ $partner->id }})"
                                    variant="ghost" 
                                    size="sm"
                                    icon="pencil"
                                />
                                <flux:button 
                                    wire:click="delete({{ $partner->id }})"
                                    wire:confirm="Are you sure you want to delete this partner?"
                                    variant="ghost" 
                                    size="sm"
                                    icon="trash"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-muted-foreground">
                                <div class="flex flex-col items-center">
                                    <x-heroicon-o-building-office-2 class="w-12 h-12 mb-3 text-muted-foreground/50" />
                                    <p>No partners found.</p>
                                    <flux:button wire:click="create" variant="primary" size="sm" class="mt-3">
                                        Add Your First Partner
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

