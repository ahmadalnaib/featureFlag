<?php
use App\Http\Controllers\Api\V1\FeatureFlagController;

Route::get('/feature-flags', [FeatureFlagController::class, 'index']);