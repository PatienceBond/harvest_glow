<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth.harvestglow')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function with()
    {
        return [
            'title' => 'Create Account',
            'description' => 'Join HarvestGlow to start making an impact in sustainable agriculture.'
        ];
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        Session::regenerate();

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
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
    @error('name')
        <div class="p-4 bg-destructive/10 border border-destructive/20 rounded-lg text-destructive text-sm">
            {{ $message }}
        </div>
    @enderror
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

    <form method="POST" wire:submit="register" class="space-y-6">
    <!-- Name -->
    <div>
        <label for="name" class="block text-sm font-medium mb-2">Full Name</label>
        <input 
            wire:model="name"
            id="name" 
            type="text" 
            required 
            autofocus 
            autocomplete="name"
            class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-destructive @enderror"
            placeholder="Enter your full name"
        >
    </div>

    <!-- Email Address -->
    <div>
        <label for="email" class="block text-sm font-medium mb-2">Email Address</label>
        <input 
            wire:model="email"
            id="email" 
            type="email" 
            required 
            autocomplete="email"
            class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-destructive @enderror"
            placeholder="Enter your email address"
        >
    </div>

    <!-- Password -->
    <div>
        <label for="password" class="block text-sm font-medium mb-2">Password</label>
        <input 
            wire:model="password"
            id="password" 
            type="password" 
            required 
            autocomplete="new-password"
            class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('password') border-destructive @enderror"
            placeholder="Create a password"
        >
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="password_confirmation" class="block text-sm font-medium mb-2">Confirm Password</label>
        <input 
            wire:model="password_confirmation"
            id="password_confirmation" 
            type="password" 
            required 
            autocomplete="new-password"
            class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
            placeholder="Confirm your password"
        >
    </div>

    <!-- Submit Button -->
    <div>
        <x-ui.loading-button type="submit" class="w-full" wire:submit="register" loadingText="Creating account...">
            Create Account
        </x-ui.loading-button>
    </div>
    </form>

    <div class="text-center text-sm text-muted-foreground">
        <span>Already have an account? </span>
        <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary/80 transition-colors">
            Log in here
        </a>
    </div>
</div>
