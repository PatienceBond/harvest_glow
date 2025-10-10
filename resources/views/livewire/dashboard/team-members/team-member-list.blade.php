<div>
    <!-- Search and Filters Bar -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8 gap-4">
        <div class="flex flex-1 gap-4 mb-4 sm:mb-0 min-w-0">
            <flux:input 
                wire:model.live.debounce.300ms="term"
                placeholder="Search members..."
                class="flex-1 min-w-[200px]"
            />
            
            <flux:select 
                wire:model.live="typeFilter"
                placeholder="All Types"
            >
                <option value="">All Types</option>
                <option value="leadership">Leadership Team</option>
                <option value="team">Our Team</option>
                <option value="board">Board of Directors</option>
            </flux:select>
        </div>
      
        <div class="mt-4 sm:mt-0">
            <flux:modal.trigger name="create-member">
                <flux:button variant="primary" icon="plus">New Member</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <!-- Members Grid -->
    @if($members->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($members as $member)
                <div class="bg-card border border-border rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-start gap-4 mb-4">
                        <!-- Photo -->
                        @if($member->photo)
                            <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}" 
                                 class="w-16 h-16 rounded-full object-cover border-2 border-border flex-shrink-0">
                        @else
                            <div class="w-16 h-16 rounded-full bg-muted flex items-center justify-center border-2 border-border flex-shrink-0">
                                <svg class="w-8 h-8 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        @endif
                        
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-foreground truncate">{{ $member->name }}</h3>
                            <p class="text-sm text-muted-foreground">{{ $member->title }}</p>
                        </div>
                    </div>

                    @if($member->bio)
                        <flux:text class="mb-4 line-clamp-3">{{ $member->bio }}</flux:text>
                    @endif

                    <div class="flex items-center justify-between pt-4 border-t border-border">
                        <flux:badge size="sm" 
                            :color="$member->type === 'leadership' ? 'blue' : ($member->type === 'board' ? 'purple' : 'zinc')">
                            {{ ucfirst($member->type) }}
                        </flux:badge>
                        <div class="flex items-center space-x-2">
                            <flux:modal.trigger wire:click="view({{ $member->id }})" name="view-member">
                                <flux:button 
                                    variant="ghost"
                                    size="sm"
                                    icon="eye"
                                />
                            </flux:modal.trigger>
                            <flux:modal.trigger wire:click="edit({{ $member->id }})" name="create-member">
                                <flux:button 
                                    variant="ghost"
                                    size="sm"
                                    icon="pencil"
                                />
                            </flux:modal.trigger>
                            <flux:button 
                                wire:click="delete({{ $member->id }})"
                                wire:confirm="Are you sure you want to delete this team member?"
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
            <x-heroicon-o-user-group class="mx-auto h-12 w-12 text-muted-foreground" />
            <h3 class="mt-2 text-sm font-medium text-foreground">No team members found</h3>
            <p class="mt-1 text-sm text-muted-foreground">
                @if($term || $typeFilter)
                    Try adjusting your search or filters.
                @else
                    Get started by adding your first team member using the button above.
                @endif
            </p>
        </div>
    @endif

    <!-- Create/Edit Modal -->
    <flux:modal name="create-member" class="md:w-[700px]">
        <livewire:dashboard.team-members.create-edit :key="'member-form'" />
    </flux:modal>

    <!-- View Modal -->
    <flux:modal name="view-member" class="md:w-[700px]">
        <livewire:dashboard.team-members.view :key="'member-view'" />
    </flux:modal>
</div>
