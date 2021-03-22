<?php

use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('check-is-valid-access-token', [UserController::class, 'checkIsValidAccessToken']);
    });
    Route::prefix('accounts')->group(function () {
        Route::get('search', [ServiceController::class, 'searchAccountByService']);
    });
});
