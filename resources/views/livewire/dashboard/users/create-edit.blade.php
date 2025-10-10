<div>
    <div class="py-4">
        <h3 class="text-lg font-semibold text-foreground">
            {{ $userId ? 'Edit User' : 'Add New User' }}
        </h3>
    </div>

    <form wire:submit="save" class="space-y-6">
        <!-- Avatar Upload -->
        <x-ui.avatar-image-upload 
            wire-model="avatar"
            :existing-image="$existing_avatar"
            label="Profile Photo (Optional)"
            help-text="Upload a profile photo (Max 1MB, JPG, PNG)"
        />

        <!-- Name -->
        <flux:input 
            wire:model="name"
            label="Full Name"
            placeholder="Enter user's full name"
            required
        />

        <!-- Email -->
        <flux:input 
            wire:model="email"
            type="email"
            label="Email Address"
            placeholder="user@example.com"
            required
        />

        <!-- Password -->
        <flux:input 
            wire:model="password"
            type="password"
            label="{{ $userId ? 'New Password (leave blank to keep current)' : 'Password' }}"
            placeholder="Enter password"
            :required="!$userId"
        />

        <!-- Password Confirmation -->
        @if($password || !$userId)
            <flux:input 
                wire:model="password_confirmation"
                type="password"
                label="Confirm Password"
                placeholder="Confirm password"
                :required="!$userId || $password"
            />
        @endif

        @if($userId)
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                <p class="text-sm text-blue-800 dark:text-blue-200">
                    <strong>Note:</strong> Leave password fields blank to keep the current password.
                </p>
            </div>
        @endif

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
                    {{ $userId ? 'Update User' : 'Add User' }}
                </span>
                <span wire:loading wire:target="save">
                    {{ $userId ? 'Updating...' : 'Adding...' }}
                </span>
            </flux:button>
        </div>
    </form>
</div>

