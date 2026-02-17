<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\LaporanController;

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        // ================= DASHBOARD =================
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // ================= USERS CRUD =================
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user_id}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user_id}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user_id}', [UserController::class, 'destroy'])->name('destroy');
        });

        // ================= KENDARAAN CRUD =================
        Route::prefix('kendaraan')->name('kendaraan.')->group(function () {
            Route::get('/', [KendaraanController::class, 'index'])->name('index');
            Route::get('/create', [KendaraanController::class, 'create'])->name('create');
            Route::post('/', [KendaraanController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [KendaraanController::class, 'edit'])->name('edit');
            Route::put('/{id}', [KendaraanController::class, 'update'])->name('update');
            Route::delete('/{id}', [KendaraanController::class, 'destroy'])->name('destroy');
        });

        // ================= AREA CRUD =================
        Route::prefix('area')->name('area.')->group(function () {
            Route::get('/', [AreaController::class, 'index'])->name('index');
            Route::get('/create', [AreaController::class, 'create'])->name('create');
            Route::post('/', [AreaController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [AreaController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AreaController::class, 'update'])->name('update');
            Route::delete('/{id}', [AreaController::class, 'destroy'])->name('destroy');
        });

        // ================= Tarif ALAT =================
        Route::prefix('tarif')->name('tarif.')->group(function () {
            Route::get('/', [TarifController::class, 'index'])->name('index');
            Route::get('/create', [TarifController::class, 'create'])->name('create');
            Route::post('/', [TarifController::class, 'store'])->name('store');
            Route::delete('/{tarif}', [TarifController::class, 'destroy'])->name('destroy');
        });

        // ================= LAPORAN =================
        Route::prefix('logs')
        ->name('logs.')
        ->group(function () {

            Route::get('/', [LaporanController::class, 'index'])
                ->name('index');

            Route::get('/{id}', [LaporanController::class, 'show'])
                ->name('show');

        });
    });
