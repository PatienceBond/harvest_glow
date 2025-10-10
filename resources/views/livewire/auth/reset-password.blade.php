<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth.harvestglow')] class extends Component {
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function with()
    {
        return [
            'title' => 'Set New Password',
            'description' => 'Please enter your new password below.'
        ];
    }

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status !== Password::PasswordReset) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
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
    @error('password')
        <div class="p-4 bg-destructive/10 border border-destructive/20 rounded-lg text-destructive text-sm">
            {{ $message }}
        </div>
    @enderror

    <form method="POST" wire:submit="resetPassword" class="space-y-6">
        <!-- Email Address -->
        <flux:input 
            wire:model="email"
            type="email"
            label="Email Address"
            placeholder="Enter your email address"
            required
            autocomplete="email"
        />

        <!-- Password -->
        <flux:input 
            wire:model="password"
            type="password"
            label="New Password"
            placeholder="Enter your new password"
            required
            autocomplete="new-password"
        />

        <!-- Confirm Password -->
        <flux:input 
            wire:model="password_confirmation"
            type="password"
            label="Confirm New Password"
            placeholder="Confirm your new password"
            required
            autocomplete="new-password"
        />

        <!-- Submit Button -->
        <flux:button 
            type="submit" 
            variant="primary" 
            class="w-full"
        >
            <span wire:loading.remove wire:target="resetPassword">Reset Password</span>
            <span wire:loading wire:target="resetPassword">Resetting...</span>
        </flux:button>
    </form>

    <div class="text-center text-sm text-muted-foreground">
        <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary/80 transition-colors">
            ← Back to Login
        </a>
    </div>
</div>
