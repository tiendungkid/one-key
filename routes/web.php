<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], 'login', [AuthenticateController::class, 'login'])->name('login');
Route::post('logout', [AuthenticateController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/', [AppController::class, 'dashboard'])->name('dashboard');
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile');
    });
    Route::prefix('setting')->group(function () {
        Route::get('/', [SettingController::class, 'show'])->name('setting');
    });
});
