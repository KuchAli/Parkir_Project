<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Models\User;

class KendaraanController extends Controller
{
    /**
     * Menampilkan daftar kendaraan
     */
    public function index()
    {
         $sortMap = [
            'newest' => ['created_at', 'desc'],
            'oldest' => ['created_at', 'asc'],
            'plat_nomor' => ['plat_nomor', 'asc'],
            'jenis_kendaraan' => ['jenis_kendaraan', 'asc'],
        ];
        
        $query = Kendaraan::query();

        //search & sort

        if (request()->has('search')) {
            $search = request('search');
            $query = Kendaraan::where('plat_nomor', 'like', "%$search%")
                ->orWhere('jenis_kendaraan', 'like', "%$search%");
        } else {
            $query = Kendaraan::query();
        }


        if (request()->has('sort') && isset($sortMap[request('sort')])) {
            $query->orderBy(...$sortMap[request('sort')]);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $kendaraan = $query->paginate(3)->withQueryString();

       
        return view('admin.kendaraan.index', compact('kendaraan'));
    }

    /**
     * Menampilkan form tambah kendaraan
     */
    public function create()
    {
        $users = User::all();
        return view('admin.kendaraan.create', compact('users'));
    }

    /**
     * Menyimpan data kendaraan
     */
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
            'warna'            => 'nullable|string|max:20'. $id . ',id_kendaraan'
            
        ]);

        $kendaraan->update([
            'warna'           => $request->warna,
            
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
