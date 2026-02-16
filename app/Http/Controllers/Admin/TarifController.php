<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarif;
use App\Models\User;
use Illuminate\Http\Request;


class TarifController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::with(['user'])
            ->latest()
            ->get();

        return view('admin.tarif.index', compact('tarifs'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('admin.tarif.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kendaraan'         => 'required|string',
            'tarif_per_jam'       => 'required|numeric|min:0',
        ]);

        Tarif::create([
            'jenis_kendaraan'     => $request->jenis_kendaraan,
            'tarif_per_jam'   => $request->tarif_per_jam,
           
            
        ]);

        return redirect()
            ->route('admin.tarif.index')
            ->with('success', 'Data berhasil dibuat');
    }

    public function destroy(Tarif $tarif)
    {
        try {
            $tarif->delete();

            return redirect()
                ->route('admin.tarif.index')
                ->with('success', 'Data berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.tarif.index')
                ->with('error', 'Gagal menghapus data');
        }
    }
}
