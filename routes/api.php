<?php

use App\Models\TeamMember;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/team-members', function () {
    return TeamMember::where('is_active', true)
        ->where('type', 'leadership')
        ->orderBy('order')
        ->get();
});
