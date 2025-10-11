<?php

use App\Models\User;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new #[Layout('components.layouts.dashboard.dashboard-layout')] class extends Component {
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public $avatar;
    public $existing_avatar;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->existing_avatar = $user->avatar;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
            'avatar' => ['nullable', 'image', 'max:1024'], // Max 1MB
        ]);

        // Handle avatar upload with optimization
        if ($this->avatar) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            // Optimize and store new avatar (200x200px, square crop, WebP)
            $imageService = new ImageService();
            $avatarPath = $imageService->optimizeAvatar($this->avatar, 200);
            $validated['avatar'] = $avatarPath;
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Update existing_avatar to reflect new avatar
        $this->existing_avatar = $user->avatar;
        $this->avatar = null;

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<div class="py-8 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-foreground">Settings</h1>
            <p class="text-muted-foreground mt-2">Manage your profile and account settings</p>
        </div>

        <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name, email and profile photo')">
            <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            
            <!-- Avatar Upload -->
            <x-ui.avatar-image-upload 
                wire-model="avatar"
                :existing-image="$existing_avatar"
                label="Profile Photo"
                help-text="Upload a profile photo (Max 1MB, JPG, PNG)"
            />

            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full" data-test="update-profile-button">
                        {{ __('Save') }}
                    </flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

            <livewire:settings.delete-user-form />
        </x-settings.layout>
    </div>
</div>
