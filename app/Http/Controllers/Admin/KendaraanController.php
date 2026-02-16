<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    /**
     * Menampilkan daftar kendaraan
     */
    public function index()
    {
        $kendaraan = Kendaraan::with('user')->latest()->get();
       
        return view('admin.kendaraan.index', compact('kendaraan'));
    }

    /**
     * Menampilkan form tambah kendaraan
     */
    public function create()
    {
        return view('admin.kendaraan.create');
    }

    /**
     * Menyimpan data kendaraan
     */
    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor'       => 'required|string|max:15|unique:kendaraan,plat_nomor',
            'jenis_kendaraan'  => 'required|string|max:20',
            'warna'            => 'nullable|string|max:20',
            'pemilik'          => 'nullable|string|max:100',
        ]);

        Kendaraan::create([
            'plat_nomor'      => $request->plat_nomor,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna'           => $request->warna,
            'pemilik'         => $request->pemilik,
            'id_user'         => Auth::id(), // user yang login
        ]);

        return redirect()
            ->route('admin.kendaraan.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit kendaraan
     */
    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('admin.kendaraan.edit', compact('kendaraan'));
    }

    /**
     * Mengupdate data kendaraan
     */
    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $request->validate([
            'plat_nomor'       => 'required|string|max:15|unique:kendaraan,plat_nomor,' . $id . ',id_kendaraan',
            'jenis_kendaraan'  => 'required|string|max:20',
            'warna'            => 'nullable|string|max:20',
            'pemilik'          => 'nullable|string|max:100',
        ]);

        $kendaraan->update([
            'plat_nomor'      => $request->plat_nomor,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna'           => $request->warna,
            'pemilik'         => $request->pemilik,
        ]);

        return redirect()
            ->route('admin.kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diperbarui');
    }

    /**
     * Menghapus data kendaraan
     */
    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return redirect()
            ->route('admin.kendaraan.index')
            ->with('success', 'Data kendaraan berhasil dihapus');
    }
}
