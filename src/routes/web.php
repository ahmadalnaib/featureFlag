<?php

use Illuminate\Support\Facades\Route;
use YourVendor\FeatureFlag\Http\Controllers\FeatureFlagController;

Route::middleware(['web', 'auth:admin'])->prefix('admin')->group(function () {
    Route::get('/features', [FeatureFlagController::class, 'index']);
    Route::post('/features', [FeatureFlagController::class, 'store']);
    Route::put('/features/{id}', [FeatureFlagController::class, 'update']);
});