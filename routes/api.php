<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('test', [UserController::class, 'test']);
    });
});
