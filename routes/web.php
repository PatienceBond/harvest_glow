<?php

use App\Livewire\Dashboard\Categories\CategoryPage;
use App\Livewire\Dashboard\Posts\PostPage;
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
Route::get('/news/{slug?}', \App\Livewire\Guests\NewsDetails::class)->name('news-details');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', \App\Livewire\Dashboard\Dashboard::class)->name('dashboard');

    // Posts routes
    Route::get('/dashboard/posts', PostPage::class)->name('dashboard.posts.index');

    // Categories routes
    Route::get('/dashboard/categories', CategoryPage::class)->name('dashboard.categories.index');

    // Impact Metrics routes
    Route::get('/dashboard/metrics', \App\Livewire\Dashboard\Metrics\Index::class)->name('dashboard.metrics.index');
});

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
