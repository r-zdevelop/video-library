<?php

use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('videos', VideoController::class)->except(['index', 'show']);
});

Route::resource('videos', VideoController::class)->only(['index', 'show']);

require __DIR__ . '/auth.php';
