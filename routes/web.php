<?php

use App\Http\Controllers\VideoController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::resource('videos', VideoController::class)->except(['index', 'show']);
});

Route::resource('videos', VideoController::class)->only(['index', 'show']);

Route::get('videos/{id}', [VideoController::class, 'show'])->name('videos.show');


require __DIR__ . '/auth.php';
