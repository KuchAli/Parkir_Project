<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\User;
use App\Models\AreaParkir;
use App\Models\Tarif;
use App\Models\Log_Aktivitas;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicles = Kendaraan::count();
        $totalUsers = User::count();
        $totalAreas = AreaParkir::count();
        $totalTarif = Tarif::count();

        $logs = Log_Aktivitas::with('user')->orderBy('waktu_aktivitas', 'desc')->paginate(3);
        
        return view('admin.dashboard', compact('totalVehicles', 'totalUsers', 'totalAreas', 'totalTarif', 'logs'));
    }
}
