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
        $query = Transaksi::whereHas('kendaraan', function($q){
            $q->where('user_id', Auth::id());
        });

        $start = null;
        $end = null;

        if ($request->start_date && $request->end_date) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();

            $query->whereBetween('waktu_masuk', [$start, $end]);
        }

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
            'query',
            'start',
            'end'
        ));
    }
}