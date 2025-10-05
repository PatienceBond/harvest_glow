<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', \App\Livewire\Guests\Home::class)->name('home');
Route::get('/about', \App\Livewire\Guests\About::class)->name('about');
Route::get('/our-model', \App\Livewire\Guests\OurModel::class)->name('our-model');
Route::get('/impact', \App\Livewire\Guests\Impact::class)->name('impact');
Route::get('/team', \App\Livewire\Guests\Team::class)->name('team');
Route::get('/partners', \App\Livewire\Guests\Partners::class)->name('partners');
Route::get('/contact', \App\Livewire\Guests\Contact::class)->name('contact');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
