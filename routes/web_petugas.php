<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Petugas\ParkirController;
use App\Http\Controllers\Petugas\TransaksiController;

Route::prefix('petugas')
    ->middleware(['auth', 'petugas'])
    ->name('petugas.')
    ->group(function () {

        // ================= DASHBOARD =================
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // ================= STRUK PARKIR =================
        Route::get('/parkir/{transaksi}/struk', [ParkirController::class, 'struk'])
            ->name('parkir.struk');
        
        //=================== Transaksi =================
        Route::get('/transaksi', [TransaksiController::class, 'index'])
            ->name('transaksi.index');
            Route::get('/transaksi/create', [TransaksiController::class, 'create'])
            ->name('transaksi.create');
            Route::post('/transaksi/masuk', [TransaksiController::class, 'masuk'])
            ->name('transaksi.masuk');
            Route::put('/transaksi/{transaksi}/keluar', [TransaksiController::class, 'keluar'])
            ->name('transaksi.keluar');
            Route::get('/transaksi/{transaksi}',[TransaksiController::class,'show'])
                ->name('transaksi.detail');
    });

?>