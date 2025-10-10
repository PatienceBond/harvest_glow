<div>
    <!-- Search Bar -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8 gap-4">
        <div class="flex flex-1 gap-4 mb-4 sm:mb-0">
            <flux:input 
                wire:model.live.debounce.300ms="term"
                placeholder="Search users..."
                class="w-full sm:w-auto flex-1 min-w-0"
            />
        </div>
      
        <div class="mt-4 sm:mt-0">
            <flux:modal.trigger name="create-user">
                <flux:button variant="primary" icon="plus">New User</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <!-- Users Grid -->
    @if($users->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($users as $user)
                <div class="bg-card border border-border rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-start gap-4 mb-4">
                        <!-- Avatar -->
                        @if($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" 
                                 class="w-16 h-16 rounded-full object-cover border-2 border-border flex-shrink-0">
                        @else
                            <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center border-2 border-border flex-shrink-0">
                                <span class="text-xl font-bold text-primary">{{ substr($user->name, 0, 2) }}</span>
                            </div>
                        @endif
                        
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-foreground truncate">{{ $user->name }}</h3>
                            <p class="text-sm text-muted-foreground truncate">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-border">
                        <flux:badge size="sm" color="zinc">
                            Joined {{ $user->created_at->diffForHumans() }}
                        </flux:badge>
                        
                        <div class="flex items-center space-x-2">
                            <flux:modal.trigger wire:click="edit({{ $user->id }})" name="create-user">
                                <flux:button 
                                    variant="ghost"
                                    size="sm"
                                    icon="pencil"
                                />
                            </flux:modal.trigger>
                            
                            @if($user->id !== auth()->id())
                                <flux:button 
                                    wire:click="delete({{ $user->id }})"
                                    wire:confirm="Are you sure you want to delete this user?"
                                    variant="danger"
                                    size="sm"
                                    icon="trash"
                                />
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    @else
        <div class="text-center py-12 bg-card border border-border rounded-lg">
            <svg class="mx-auto h-12 w-12 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-foreground">No users found</h3>
            <p class="mt-1 text-sm text-muted-foreground">
                @if($term)
                    Try adjusting your search.
                @else
                    Get started by adding a new user.
                @endif
            </p>
        </div>
    @endif

    <!-- Create/Edit Modal -->
    <flux:modal name="create-user" class="md:w-[600px]">
        <livewire:dashboard.users.create-edit :$userId :key="'user-form-' . ($userId ?? 'new')" />
    </flux:modal>
</div>

