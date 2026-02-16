<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\User;
use App\Models\AreaParkir;
use App\Models\Tarif;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicles = Kendaraan::count();
        $totalUsers = User::count();
        $totalAreas = AreaParkir::count();
        $totalTarif = Tarif::count();
        
        return view('admin.dashboard', compact('totalVehicles', 'totalUsers', 'totalAreas', 'totalTarif'));
    }
}
