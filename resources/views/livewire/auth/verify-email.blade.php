<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth.harvestglow')] class extends Component {
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    /**
     * Handle the component's rendering hook.
     */
    public function rendering(View $view): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }
    }
}; ?>

<div class="text-center space-y-6">
    <div>
        <x-heroicon-o-envelope class="w-16 h-16 text-primary mx-auto mb-4" />
        <h2 class="text-2xl font-bold text-foreground mb-2">Verify Your Email</h2>
        <p class="text-muted-foreground">
            Please verify your email address by clicking on the link we just emailed to you.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="p-4 bg-success/10 border border-success/20 rounded-lg text-success text-sm">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="space-y-4">
        <button wire:click="sendVerification" class="w-full bg-primary text-white py-3 px-4 rounded-lg hover:bg-primary/90 transition-colors font-medium">
            Resend Verification Email
        </button>

        <button wire:click="logout" class="w-full text-muted-foreground hover:text-foreground transition-colors text-sm">
            Log out
        </button>
    </div>
</div>
