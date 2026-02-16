<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log_Aktivitas;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $logs = Log_Aktivitas::with('user')->orderBy('waktu_aktivitas', 'desc')->get();
        return view('admin.logs.index', compact('logs'));
    }

    public function generate()
    {
        Log_Aktivitas::create([
            'id_user' => Auth::id(),
            'aktivitas' => 'Parkir Motor / Mobil',
            'waktu_aktivitas' => now(),
        ]);

        return back()->with('success', 'Log berhasil dibuat');
    }

}
