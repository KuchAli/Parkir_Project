<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\AreaParkir;
use App\Models\Transaksi;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['user', 'area', 'tarif', 'kendaraan'])
            ->latest()
            ->get();

        return view('petugas.transaksi.index', compact('transaksi'));
    }

    public function show($id){
        
        $transaksi = Transaksi::with(['user', 'area', 'tarif', 'kendaraan'])->findOrFail($id);
        $kendaraan = Kendaraan::all();
        $area = AreaParkir::all();
        return view ('petugas.transaksi.detail', compact('transaksi','kendaraan','area'));
    }

    public function create(){
        $transaksi = Transaksi::with(['user','area','tarif','kendaraan'])->get();
        $kendaraan = Kendaraan::all();
        $area = AreaParkir::all();
        return view('petugas.transaksi.create', compact('transaksi', 'kendaraan', 'area'));
    }
    

   public function masuk(Request $request)
    {
        $request->validate([
            'id_kendaraan' => 'required|exists:kendaraan,id_kendaraan',
            'id_area' => 'required|exists:area_parkir,id_area'
        ]);

        Log::info('Data masuk:', $request->all());

        // Cek apakah kendaraan sudah parkir
        $cek = Transaksi::where('id_kendaraan', $request->id_kendaraan)
                ->where('status', 'masuk')
                ->first();

        if ($cek) {
            return back()->with('error', 'Kendaraan masih dalam area parkir!');
        }

        $area = AreaParkir::findOrFail($request->id_area);
        
        // ✅ Hitung sisa slot sesuai dengan database (kapasitas - terisi)
        $sisa_slot = $area->kapasitas - $area->terisi;
        
        if ($sisa_slot <= 0) {
            return back()->with('error', 'Slot parkir penuh!');
        }

        

        // Buat transaksi
        Transaksi::create([
            'user_id' => Auth::id(),
            'id_kendaraan' => $request->id_kendaraan,
            'id_area' => $request->id_area,
            'waktu_masuk' => now(),
            'status' => 'masuk',
            'id_tarif'=>1
        ]);

        // ✅ Tambah terisi
        $area->increment('terisi');

        return redirect()->route('petugas.transaksi.index')
                ->with('success', 'Kendaraan berhasil masuk parkir.');
    }

    public function keluar($id)
    {
        $transaksi = Transaksi::with('kendaraan')->findOrFail($id);

        if ($transaksi->status != 'masuk') {
            return back()->with('error', 'Transaksi tidak valid atau sudah keluar');
        }

        $waktu_keluar = now();
        $durasi_jam = ceil(
            (strtotime($waktu_keluar) - strtotime($transaksi->waktu_masuk)) / 3600
        );
        
        $durasi_jam = max($durasi_jam, 1); // Minimal 1 jam

        // Logika tarif
        $tarif = $transaksi->kendaraan->jenis_kendaraan == 'mobil' ? 10000 : 5000;
        $biaya_total = $durasi_jam * $tarif;

        $transaksi->update([
            'waktu_keluar' => $waktu_keluar,
            'durasi_jam'   => $durasi_jam,
            'biaya_total'  => $biaya_total,
            'status'       => 'keluar'
        ]);

        // ✅ Kurangi terisi
        $area = AreaParkir::find($transaksi->id_area);
        $area->decrement('terisi');

        return redirect()->route('petugas.transaksi.index')
                ->with('success', 'Kendaraan keluar. Total bayar: Rp ' . number_format($biaya_total, 0, ',', '.'));
    }

}
