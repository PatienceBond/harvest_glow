<?php

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Features;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth.harvestglow')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        $user = $this->validateCredentials();

        if (Features::canManageTwoFactorAuthentication() && $user->hasEnabledTwoFactorAuthentication()) {
            Session::put([
                'login.id' => $user->getKey(),
                'login.remember' => $this->remember,
            ]);

            $this->redirect(route('two-factor.login'), navigate: true);

            return;
        }

        Auth::login($user, $this->remember);

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Validate the user's credentials.
     */
    protected function validateCredentials(): User
    {
        $user = Auth::getProvider()->retrieveByCredentials(['email' => $this->email, 'password' => $this->password]);

        if (! $user || ! Auth::getProvider()->validateCredentials($user, ['password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        return $user;
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
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

    <form method="POST" wire:submit="login" class="space-y-6">
    <!-- Email Address -->
    <div>
        <label for="email" class="block text-sm font-medium mb-2">Email Address</label>
        <input 
            wire:model="email"
            id="email" 
            type="email" 
            required 
            autofocus 
            autocomplete="email"
            class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-destructive @enderror"
            placeholder="Enter your email address"
        >
    </div>

    <!-- Password -->
    <div>
        <div class="flex justify-between items-center mb-2">
            <label for="password" class="block text-sm font-medium">Password</label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-primary hover:text-primary/80 transition-colors">
                    Forgot your password?
                </a>
            @endif
        </div>
        <input 
            wire:model="password"
            id="password" 
            type="password" 
            required 
            autocomplete="current-password"
            class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('password') border-destructive @enderror"
            placeholder="Enter your password"
        >
    </div>

    <!-- Remember Me -->
    <div class="flex items-center">
        <input 
            wire:model="remember"
            id="remember" 
            type="checkbox" 
            class="h-4 w-4 text-primary focus:ring-primary border-border rounded"
        >
        <label for="remember" class="ml-2 block text-sm text-muted-foreground">
            Remember me
        </label>
    </div>

    <!-- Submit Button -->
    <div>
        <button type="submit" class="w-full bg-primary text-white py-3 px-4 rounded-lg hover:bg-primary/90 transition-colors font-medium">
            Log In
        </button>
    </div>
    </form>
</div>
