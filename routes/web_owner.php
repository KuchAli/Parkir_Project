<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\KendaraanController;
use App\Http\Controllers\Owner\BookingController;

Route::prefix('owner')
        ->middleware(['auth', 'owner'])
        ->name('owner.')
        ->group(function(){


        //Route untuk dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');

                
        Route::resource('kendaraan', KendaraanController::class);

        Route::resource('reservasi', BookingController::class);

        Route::delete('reservasi/{id}', [BookingController::class, 'destroy'])
                ->name('reservasi.destroy');
});
