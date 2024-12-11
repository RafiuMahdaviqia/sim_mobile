<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DosenProfileController;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'dosen'], function () {
        Route::post('/profile', [DosenProfileController::class, 'store']);
        Route::get('/profile/{id}', [DosenProfileController::class, 'show']);
        Route::post('/profile/{id}', [DosenProfileController::class, 'update']);
        Route::get('/test', function() {
            return response()->json(['message' => 'API is working']);
        });
    });
});