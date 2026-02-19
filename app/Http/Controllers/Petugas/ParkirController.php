<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class ParkirController extends Controller
{
    public function struk(Transaksi$transaksi)
    {
        $parkir=$transaksi->load(['user', 'area', 'tarif','kendaraan']);
        return view('petugas.parkir.struk', compact('parkir'));
    }
}
