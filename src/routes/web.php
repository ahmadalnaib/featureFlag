
<?php

use App\Http\Controllers\FeatureFlagController;



Route::prefix('admin')->group(function () {
 
    Route::post('/features', [FeatureFlagController::class, 'store']);
    Route::put('/features/{id}', [FeatureFlagController::class, 'update']);
});
