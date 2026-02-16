<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AreaParkir;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class AreaController extends Controller
{
    public function index()
    {
        $areas = AreaParkir::all();
        return view('admin.area.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.area.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);

        AreaParkir::create([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'terisi' => 0, // Set default terisi ke 0 saat membuat area baru
        ]);

        return redirect()
            ->route('admin.area.index')
            ->with('success', 'Area parkir berhasil ditambahkan');
    }

    public function edit(AreaParkir $area)
    {
        return view('admin.area.edit', compact('area'));
    }

    public function update(Request $request, AreaParkir $area)
    {
        $request->validate([
            'nama_area' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $area->update([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()
            ->route('admin.area.index')
            ->with('success', 'Area parkir berhasil diperbarui');
    }

    public function destroy(AreaParkir $area)
    {
        try {
            $area->delete();

            return redirect()
                ->route('admin.area.index')
                ->with('success', 'Area parkir berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.area.index')
                ->with('error', 'Gagal menghapus area parkir');
        }
    }

    //fungsi untuk menyinkronkan jumlah terisi di area parkir berdasarkan transaksi yang sedang aktif
    public function syncTerisi()
    {
        $areas = AreaParkir::all();

        foreach ($areas as $area) {
            $real = Transaksi::where('id_area', $area->id)
                            ->whereIn('status', ['masuk', 'keluar'])
                            ->count();

            $area->update(['terisi' => $real]);
        }
    }

}