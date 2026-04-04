<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    public function index()
{
        if (Auth::user()->role !== 'owner') {
            abort(403);
        }

        $kendaraan = Kendaraan::where('user_id', Auth::id())->get();
        return view('owner.kendaraan.index', compact('kendaraan'));
    }

    public function create()
    {
        $kendaraan = Kendaraan::where('user_id', Auth::id())->get();
        return view('owner.kendaraan.create', compact('kendaraan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor'       => 'required|string|max:15|unique:kendaraan,plat_nomor',
            'jenis_kendaraan'  => 'required|string|',
            'warna'            => 'nullable|string|max:20',
            'user_id'          => 'required|exists:user,user_id'

        ]);

        Kendaraan::create([
            'plat_nomor'      => $request->plat_nomor,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna'           => $request->warna,
            'user_id'         => $request->user_id, 
        ]);

        
        return redirect()
            ->route('admin.kendaraan.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('owner.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $request->validate([
            'warna'            => 'nullable|string|max:20'. $id . ',id_kendaraan',
            'plat_nomor'       => 'required|string|max:15|unique:kendaraan,plat_nomor,' . $id . ',id_kendaraan'
            
        ]);

        $kendaraan->update([
            'warna'           => $request->warna,
            'plat_nomor'      => $request->plat_nomor,
            
        ]);

        return redirect()
            ->route('admin.kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diupdate');
    }

}
