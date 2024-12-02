<?php
use App\Http\Controllers\Api\V1\FeatureFlagController;

Route::prefix('v1')->group(function () {
    Route::get('/feature-flags', [FeatureFlagController::class, 'index']);
    });