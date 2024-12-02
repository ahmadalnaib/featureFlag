
<?php
use App\Http\Controllers\FeatureFlagController;


    Route::get('/features', [FeatureFlagController::class, 'index']);
    Route::post('/features', [FeatureFlagController::class, 'store']);
    Route::put('/features/{id}', [FeatureFlagController::class, 'update'])