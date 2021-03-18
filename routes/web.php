<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthenticateController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], 'login', [AuthenticateController::class, 'login'])->name('login');
Route::post('logout', [AuthenticateController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/', [AppController::class, 'dashboard'])->name('dashboard');
});
