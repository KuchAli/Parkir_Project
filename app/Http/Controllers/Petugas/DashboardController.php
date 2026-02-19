<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\AreaParkir;
use App\Models\Transaksi;


class DashboardController extends Controller
{
  public function index()
    {
        $query = AreaParkir::query();

        $sort = request('sort');

        if ($sort === 'sisa') {
            $query->orderByRaw('kapasitas - terisi asc');
        } else {

            $sortMap = [
                'nama' => 'nama_area',
                'terisi' => 'terisi',
            ];

            if (!array_key_exists($sort, $sortMap)) {
                $sort = 'nama';
            }

            $query->orderBy($sortMap[$sort], 'asc');
        }

        $area = $query->paginate(3);

        $masukHariIni = Transaksi::whereDate('waktu_masuk', now()->toDateString())->count();
        $keluarHariIni = Transaksi::whereDate('waktu_keluar', now()->toDateString())->count();
        $totalTransaksi = Transaksi::count();

        return view('petugas.dashboard', compact(
            'masukHariIni',
            'keluarHariIni',
            'totalTransaksi',
            'area'
        ));
    }

}
