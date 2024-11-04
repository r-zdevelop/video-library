<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\AnalyticsController;
use App\Http\Middleware\IsAdmin;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    // Admin routes
    Route::middleware([IsAdmin::class])->group(function () {
        Route::post('/videos', [VideoController::class, 'store']);         // Add a video
        Route::put('/videos/{id}', [VideoController::class, 'update']);    // Update a video
        Route::delete('/videos/{id}', [VideoController::class, 'destroy']); // Delete a video
    });

    // User routes
    Route::get('/videos', [VideoController::class, 'index']);                // List or search videos
    Route::get('/videos/{id}', [VideoController::class, 'show']);            // Show video details
    Route::post('/videos/{id}/view', [AnalyticsController::class, 'trackView']); // Track video view
    Route::post('/videos/search', [AnalyticsController::class, 'trackSearch']);  // Track video search
});
