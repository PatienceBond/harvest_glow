<?php

use App\Livewire\Dashboard\Categories\CategoryPage;
use App\Livewire\Dashboard\Posts\PostPage;
use App\Livewire\Dashboard\TeamMembers\TeamMemberPage;
use App\Livewire\Dashboard\Users\UserPage;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', \App\Livewire\Guests\Home::class)->name('home');
Route::get('/about', \App\Livewire\Guests\About::class)->name('about');
Route::get('/our-model', \App\Livewire\Guests\OurModel::class)->name('our-model');
Route::get('/impact', \App\Livewire\Guests\Impact::class)->name('impact');
Route::get('/team', \App\Livewire\Guests\Team::class)->name('team');
Route::get('/partners', \App\Livewire\Guests\Partners::class)->name('partners');
Route::get('/publications', \App\Livewire\Guests\Publications::class)->name('publications');
Route::get('/publications/{publication}/download', function (\App\Models\Publication $publication) {
    $path = \Illuminate\Support\Facades\Storage::disk('public')->path($publication->file_path);
    $name = \Illuminate\Support\Str::slug($publication->title) . '.pdf';
    return response()->download($path, $name);
})->name('publications.download');
Route::get('/publications/{publication}/file', function (\App\Models\Publication $publication) {
    $path = \Illuminate\Support\Facades\Storage::disk('public')->path($publication->file_path);
    return response()->file($path, [
        'Content-Type' => 'application/pdf',
        'Cache-Control' => 'public, max-age=3600',
    ]);
})->name('publications.file');
Route::get('/contact', \App\Livewire\Guests\Contact::class)->name('contact');
Route::get('/news/{slug?}', \App\Livewire\Guests\NewsDetails::class)->name('news-details');

// Storage symlink route - for deployment/setup purposes
Route::get('/setup/storage-link', function () {
    try {
        $target = storage_path('app/public');
        $link = public_path('storage');

        // Check if symlink already exists
        if (file_exists($link)) {
            return response()->json([
                'status' => 'info',
                'message' => 'The "public/storage" directory already exists.'
            ], 200);
        }

        // Check if target directory exists
        if (!file_exists($target)) {
            return response()->json([
                'status' => 'error',
                'message' => 'The target directory "storage/app/public" does not exist.'
            ], 500);
        }

        // Create the symbolic link manually
        if (symlink($target, $link)) {
            return response()->json([
                'status' => 'success',
                'message' => 'The storage symlink has been created successfully!'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create storage symlink. Check file permissions.'
            ], 500);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to create storage symlink: ' . $e->getMessage()
        ], 500);
    }
})->name('setup.storage-link');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', \App\Livewire\Dashboard\Dashboard::class)->name('dashboard');

    // Posts routes
    Route::get('/dashboard/posts', PostPage::class)->name('dashboard.posts.index');

    // Categories routes
    Route::get('/dashboard/categories', CategoryPage::class)->name('dashboard.categories.index');

    // Team Members routes
    Route::get('/dashboard/team-members', TeamMemberPage::class)->name('dashboard.team.index');

    // Users routes
    Route::get('/dashboard/users', UserPage::class)->name('dashboard.users.index');

    // Impact Metrics routes
    Route::get('/dashboard/metrics', \App\Livewire\Dashboard\Metrics\Index::class)->name('dashboard.metrics.index');

    // Products routes
    Route::get('/dashboard/products', \App\Livewire\Dashboard\Products\Index::class)->name('dashboard.products.index');

    // Publications routes
    Route::get('/dashboard/publications', \App\Livewire\Dashboard\Publications\Index::class)->name('dashboard.publications.index');

    // Partners routes
    Route::get('/dashboard/partners', \App\Livewire\Dashboard\Partners\Index::class)->name('dashboard.partners.index');

    // Hero Sections routes
    Route::get('/dashboard/hero-sections', \App\Livewire\Dashboard\HeroSections\Index::class)->name('dashboard.hero.index');
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
