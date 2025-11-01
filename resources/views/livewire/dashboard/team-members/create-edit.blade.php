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
        <x-ui.avatar-image-upload 
            wire-model="photo"
            :existing-image="$existing_photo"
            label="Profile Photo (Optional)"
            help-text="Upload a profile photo (Max 1MB, JPG, PNG)"
        />


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
