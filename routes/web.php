<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], 'login', [AuthenticateController::class, 'login'])->name('login');
Route::post('logout', [AuthenticateController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/', [AppController::class, 'dashboard'])->name('dashboard');
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile');
    });
    Route::prefix('users')->group(function () {
        Route::match(['GET', 'POST'], 'refresh-access-token', [UserController::class, 'refreshAccessToken'])
            ->name('users.refresh-access-token');
    });
    Route::prefix('setting')->group(function () {
        Route::get('/', [SettingController::class, 'show'])->name('setting');
    });
    # ------------------
    # Service routes
    # ------------------
    Route::prefix('services')->group(function () {
        Route::match(['get', 'post'], 'import', [ServiceController::class, 'import'])
            ->name('services.import');
        Route::get('export', [ServiceController::class, 'export'])
            ->name('services.export');
        Route::post('truncate', [ServiceController::class, 'truncate'])
            ->name('services.truncate');
        Route::get('datatable', [ServiceController::class, 'datatable'])
            ->name('services.datatable');
    });
    Route::resource('services', ServiceController::class)
        ->only(['index', 'create', 'store', 'show', 'update', 'destroy']);
    # ------------------
    # Account routes
    # ------------------
    Route::prefix('accounts')->group(function () {
        Route::match(['get', 'post'], 'import', [AccountController::class, 'import'])->name('accounts.import');
        Route::get('export', [AccountController::class, 'export'])->name('accounts.export');
        Route::get('truncate', [AccountController::class, 'truncate'])->name('accounts.truncate');
        Route::get('list/{id}', [AccountController::class, 'list'])->name('accounts.list');
    });
    Route::resource('accounts', AccountController::class)
        ->except('edit');
});
