<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
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
    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'show'])->name('services');
        Route::get('detail/{id}', [ServiceController::class, 'detail'])->name('services.detail');
        Route::match(['get', 'post'], 'import', [ServiceController::class, 'import'])->name('services.import');
        Route::get('export', [ServiceController::class, 'export'])->name('services.export');
        Route::get('new', [ServiceController::class, 'new'])->name('services.new');
        Route::post('store', [ServiceController::class, 'store'])->name('services.store');
        Route::post('update', [ServiceController::class, 'update'])->name('services.update');
        Route::get('search', [ServiceController::class, 'search'])->name('services.search');
        Route::post('delete', [ServiceController::class, 'delete'])->name('services.delete');
    });
    Route::prefix('accounts')->group(function () {
        Route::get('/', [AccountController::class, 'show'])->name('accounts');
        Route::get('detail/{id}', [AccountController::class, 'detail'])->name('accounts.detail');
        Route::get('new/{id}', [AccountController::class, 'new'])->name('accounts.new');
        Route::get('list/{id}', [AccountController::class, 'list'])->name('accounts.list');
        Route::post('store', [AccountController::class, 'store'])->name('accounts.store');
        Route::post('update', [AccountController::class, 'update'])->name('accounts.update');
        Route::match(['get', 'post'], 'import', [AccountController::class, 'import'])->name('accounts.import');
        Route::get('export', [AccountController::class, 'export'])->name('accounts.export');
    });
});
