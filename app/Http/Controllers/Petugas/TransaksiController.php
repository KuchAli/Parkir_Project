<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\AreaParkir;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['user', 'area_parkir', 'tarif','kendaraan'])
            ->latest()
            ->get();
        return view('petugas.transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        return view('petugas.transaksi.create');
    }

    public function store(Request $request)
    {
        $area = AreaParkir::findOrFail($request->id_area);

        if ($area->terisi >= $area->kapasitas) {
            return back()->with('error', 'Area penuh');
        }

        Transaksi::create([
            'kendaraan_id' => $request->id_kendaraan,
            'area_id' => $area->id_area,
            'status' => 'masuk'
        ]);

        $area->increment('terisi');

        return back()->with('success', 'Kendaraan masuk');
    }

   

    public function keluar($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status != 'masuk') {
            return back()->with('error', 'Belum bayar');
        }

        $transaksi->update([
            'status' => 'keluar'
        ]);

        $area = AreaParkir::find($transaksi->area_id);
        $area->decrement('terisi');

        return back()->with('success', 'Kendaraan keluar');
    }

}
