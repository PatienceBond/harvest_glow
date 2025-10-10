<div class="">
    <!-- Header -->
    <div class="py-4">
        <h3 class="text-lg font-semibold text-foreground">Team Member Details</h3>
    </div>

    @if($member)
        <div class="space-y-6">
            <!-- Photo -->
            @if($member->photo)
                <div class="flex justify-center">
                    <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}" class="w-32 h-32 object-cover rounded-full border border-border">
                </div>
            @endif

            <!-- Name & Title -->
            <div class="text-center">
                <h2 class="text-2xl font-bold text-foreground">{{ $member->name }}</h2>
                <p class="text-lg text-muted-foreground mt-1">{{ $member->title }}</p>
                <flux:badge 
                    :color="$member->type === 'leadership' ? 'blue' : ($member->type === 'board' ? 'purple' : 'zinc')"
                    class="mt-2"
                >
                    {{ ucfirst($member->type) }}
                </flux:badge>
            </div>

            <!-- Bio -->
            @if($member->bio)
                <div>
                    <h4 class="text-sm font-semibold text-foreground mb-2">Biography</h4>
                    <div class="text-foreground leading-relaxed">
                        {{ $member->bio }}
                    </div>
                </div>
            @endif

            <!-- Metadata -->
            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-border">
                <div>
                    <h4 class="text-sm font-semibold text-foreground mb-1">Display Order</h4>
                    <span class="text-sm text-foreground">{{ $member->order }}</span>
                </div>

                <div>
                    <h4 class="text-sm font-semibold text-foreground mb-1">Status</h4>
                    <flux:badge :color="$member->is_active ? 'green' : 'zinc'" size="sm">
                        {{ $member->is_active ? 'Active' : 'Inactive' }}
                    </flux:badge>
                </div>

                <div>
                    <h4 class="text-sm font-semibold text-foreground mb-1">Added</h4>
                    <span class="text-sm text-foreground">{{ $member->created_at->format('F d, Y') }}</span>
                </div>

                <div>
                    <h4 class="text-sm font-semibold text-foreground mb-1">Last Updated</h4>
                    <span class="text-sm text-foreground">{{ $member->updated_at->format('F d, Y') }}</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-border">
                <flux:modal.close>
                    <flux:button variant="ghost">Close</flux:button>
                </flux:modal.close>
                <flux:button wire:click="$dispatch('edit-member', { memberId: {{ $member->id }} })" variant="primary" icon="pencil">
                    Edit Member
                </flux:button>
            </div>
        </div>
    @else
        <div class="py-8 text-center">
            <p class="text-muted-foreground">Loading member details...</p>
        </div>
    @endif
</div>
