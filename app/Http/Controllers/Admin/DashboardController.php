<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\User;
use App\Models\AreaParkir;
use App\Models\Tarif;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicles = Kendaraan::count();
        $totalUsers = User::count();
        $totalAreas = AreaParkir::count();
        $totalTarif = Tarif::count();

        $sortMap = [
            'newest' => ['created_at', 'desc'],
            'oldest' => ['created_at', 'asc'],
        ];

        $query = Transaksi::with('user');

        // SEARCH
        if (request()->has('search') && request('search') != '') {
            $search = request('search');

            $query->whereHas('user', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%")
                ->orWhere('username', 'like', "%$search%");
            });
        }

        // SORT
        if (request()->has('sort') && isset($sortMap[request('sort')])) {
            $query->orderBy(...$sortMap[request('sort')]);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $logs = $query->paginate(3)->withQueryString();

        
        return view('admin.dashboard', compact('totalVehicles', 'totalUsers', 'totalAreas', 'totalTarif', 'logs'));
    }
}
