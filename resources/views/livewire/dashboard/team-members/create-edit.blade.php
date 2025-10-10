<div>
    <div class="py-4">
        <h3 class="text-lg font-semibold text-foreground">
            {{ $memberId ? 'Edit Team Member' : 'Add New Team Member' }}
        </h3>
    </div>

    <form wire:submit="save" class="space-y-6">
        <!-- Name -->
        <flux:input 
            wire:model="name"
            label="Name"
            placeholder="Full name"
        />

        <!-- Title -->
        <flux:input 
            wire:model="title"
            label="Title/Role"
            placeholder="e.g. Executive Director, Board Member"
        />

        <!-- Bio -->
        <flux:textarea 
            wire:model="bio"
            label="Bio"
            rows="5"
            placeholder="Brief biography (optional for board members)"
        />

        <!-- Type -->
        <flux:select 
            wire:model="type"
            label="Type"
        >
            <option value="leadership">Leadership Team</option>
            <option value="team">Our Team</option>
            <option value="board">Board of Directors</option>
        </flux:select>

        <!-- Photo -->
        <flux:field>
            <flux:label>Photo (Optional)</flux:label>
            
            @if($existing_photo && !$photo)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $existing_photo) }}" alt="Current photo" class="w-32 h-32 object-cover rounded-lg border border-border">
                    <flux:button 
                        wire:click="removeExistingPhoto"
                        variant="ghost"
                        size="sm"
                        type="button"
                        class="mt-2"
                    >
                        Remove existing photo
                    </flux:button>
                </div>
            @endif

            <input 
                type="file" 
                wire:model="photo"
                accept="image/*"
                class="w-full border border-border rounded-lg p-2"
            />
            
            @if($photo)
                <div class="mt-3 flex items-center gap-2">
                    <span class="text-sm text-muted-foreground">New photo selected</span>
                    <flux:button 
                        wire:click="removeFile"
                        variant="ghost"
                        size="sm"
                        type="button"
                    >
                        Remove
                    </flux:button>
                </div>
            @endif

            <flux:error name="photo" />
            
            <div wire:loading wire:target="photo" class="mt-2 text-sm text-muted-foreground">
                Uploading...
            </div>
        </flux:field>

        <!-- Order & Active Status -->
        <div class="grid grid-cols-2 gap-4">
            <flux:input 
                wire:model="order"
                type="number"
                label="Display Order"
                placeholder="0"
            />
            
            <flux:checkbox 
                wire:model="is_active"
                label="Active"
                description="Show on website"
            />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-border">
            <flux:modal.close>
                <flux:button variant="filled">Cancel</flux:button>
            </flux:modal.close>
            <flux:button 
                type="submit" 
                variant="primary"     
            >
                <span wire:loading.remove wire:target="save">
                    {{ $memberId ? 'Update' : 'Add' }} Member
                </span>
                <span wire:loading wire:target="save">
                    {{ $memberId ? 'Updating...' : 'Adding...' }}
                </span>
            </flux:button>
        </div>
    </form>
</div>
