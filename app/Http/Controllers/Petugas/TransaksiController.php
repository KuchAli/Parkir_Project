<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\AreaParkir;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['user', 'area_parkir', 'tarif','kendaraan'])
            ->latest()
            ->get();
        return view('petugas.transaksi.index', compact('transaksi'));
    }

   public function formMasuk()
    {
        return view('petugas.transaksi.create');
    }

    public function masuk(Request $request)
{
    $area = AreaParkir::findOrFail($request->id_area);

    // 1. Validasi kapasitas
    if ($area->terisi >= $area->kapasitas) {
        return back()->with('error', 'Area penuh');
    }

    // 2. Simpan transaksi MASUK saja (tanpa hitung biaya)
    Transaksi::create([
        'id_kendaraan' => $request->id_kendaraan,
        'user_id'      => Auth::id(),
        'id_area'      => $area->id_area,
        'id_tarif'     => $request->id_tarif,
        'waktu_masuk'  => now(),
        'waktu_keluar' => null,
        'durasi_jam'   => null,
        'biaya_total'  => null,
        'status'       => 'masuk'
    ]);

    // 3. Tambah jumlah terisi
    $area->increment('terisi');

    return back()->with('success', 'Kendaraan berhasil masuk');
}


   

   public function keluar($id)
    {
        $transaksi = Transaksi::with('kendaraan')->findOrFail($id);

        if ($transaksi->status != 'masuk') {
            return back()->with('error', 'Belum Bayar');
        }

        $waktu_keluar = now();
        $durasi_jam = ceil(
            (strtotime($waktu_keluar) - strtotime($transaksi->waktu_masuk)) / 3600
        );

        // logika tarif
        if ($transaksi->kendaraan->jenis_kendaraan == 'mobil') {
            $tarif = 10000;
        } else {
            $tarif = 5000;
        }

        $biaya_total = $durasi_jam * $tarif;

        $transaksi->update([
            'waktu_keluar' => $waktu_keluar,
            'durasi_jam'   => $durasi_jam,
            'biaya_total' => $biaya_total,
            'status'      => 'keluar'
        ]);

        $area = AreaParkir::find($transaksi->id_area);
        $area->decrement('terisi');

        return back()->with('success', 'Total bayar: Rp ' . number_format($biaya_total));
    }


}
