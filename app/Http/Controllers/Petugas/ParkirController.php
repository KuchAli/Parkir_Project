<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class ParkirController extends Controller
{
    public function struk($id)
    {
        $parkir= Transaksi::with(['user', 'area_parkir', 'tarif','kendaraan'])
            ->findOrFail($id);
        return view('petugas.parkir.struk', compact('parkir'));
    }
}
