<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\DashboardController;

Route::prefix('owner')
        ->middleware(['auth', 'owner'])
        ->name('owner.')
        ->group(function(){


        //Route untuk dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');

        });
