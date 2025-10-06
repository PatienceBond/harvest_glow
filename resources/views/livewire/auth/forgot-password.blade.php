<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth.harvestglow')] class extends Component {
    public string $email = '';

    public function with()
    {
        return [
            'title' => 'Reset Password',
            'description' => 'Enter your email address and we\'ll send you a link to reset your password.'
        ];
    }

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }
}; ?>

<div class="space-y-6">
    <!-- Session Status -->
    @if (session('status'))
        <div class="p-4 bg-success/10 border border-success/20 rounded-lg text-success text-sm">
            {{ session('status') }}
        </div>
    @endif

    <!-- Error Messages -->
    @error('email')
        <div class="p-4 bg-destructive/10 border border-destructive/20 rounded-lg text-destructive text-sm">
            {{ $message }}
        </div>
    @enderror

    <form method="POST" wire:submit="sendPasswordResetLink" class="space-y-6">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium mb-2">Email Address</label>
            <input 
                wire:model="email"
                id="email" 
                type="email" 
                required 
                autofocus
                class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-destructive @enderror"
                placeholder="Enter your email address"
            >
        </div>

        <!-- Submit Button -->
        <div>
            <x-ui.loading-button type="submit" class="w-full" wire:submit="sendPasswordResetLink" loadingText="Sending...">
                Send Password Reset Link
            </x-ui.loading-button>
        </div>
    </form>

    <div class="text-center text-sm text-muted-foreground">
        <span>Remember your password? </span>
        <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary/80 transition-colors">
            Return to log in
        </a>
    </div>
</div>
