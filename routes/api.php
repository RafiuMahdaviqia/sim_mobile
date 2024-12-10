<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DosenProfileController;

Route::prefix('v1')->group(function () {
    Route::prefix('dosen')->group(function () {
        Route::post('profile', [DosenProfileController::class, 'store']);
        Route::get('profile/{id}', [DosenProfileController::class, 'show']);
        Route::post('profile/{id}', [DosenProfileController::class, 'update']);
    });
});