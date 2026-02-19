<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log_Aktivitas;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index()
    {
        $sortMap = [
            'newest' => ['waktu_aktivitas', 'desc'],
            'oldest' => ['waktu_aktivitas', 'asc'],
        ];
        $query = Log_Aktivitas::with('user')->orderBy('waktu_aktivitas', 'desc');

        if (request()->has('search')) {
            $search = request('search');
            $query = Log_Aktivitas::whereHas('user', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%")
                  ->orWhere('username', 'like', "%$search%");
            })->with('user')->orderBy('waktu_aktivitas', 'desc');
        } else {
            $query = Log_Aktivitas::with('user')->orderBy('waktu_aktivitas', 'desc');
        }

        if (request()->has('sort') && isset($sortMap[request('sort')])) {
            $query->orderBy(...$sortMap[request('sort')]);
        } else {
            $query->orderBy('waktu_aktivitas', 'desc');
        }

        $logs = $query->paginate(3)->withQueryString();
        return view('admin.logs.index', compact('logs'));
    }

    public function generate()
    {
        $logs = Log_Aktivitas::all();
        foreach ($logs as $log) {
                $aktivitas = Transaksi::where('id_parkir', $log->id)
                                    ->whereIn('status', ['masuk', 'keluar']) 
                                    ->first();   

                $log->create([
                    'user_id' => $log->user_id,
                    'aktivitas' => $aktivitas ? $aktivitas->status : 'masuk/keluar',
                    'waktu_aktivitas' => $log->waktu_aktivitas->now(),
                ]);
               
            }

            

    }



}
