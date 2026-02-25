<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->start_date 
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::today()->startOfDay();

        $end = $request->end_date 
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::today()->endOfDay();

        // Query khusus transaksi milik user login
        $query = Transaksi::whereBetween('waktu_masuk', [$start, $end])
            ->whereHas('kendaraan', function($q){
                $q->where('user_id', Auth::id());
            });

        $totalTransaksi = $query->count();

        $totalPengeluaran = $query->sum('biaya_total');

        $transaksi = $query
            ->with(['kendaraan','area'])
            ->orderBy('waktu_masuk', 'desc')
            ->paginate(10);

        return view('owner.dashboard', compact(
            'totalTransaksi',
            'totalPengeluaran',
            'transaksi',
            'start',
            'end'
        ));
    }
}