<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\AreaParkir;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $booking = Transaksi::where('user_id', Auth::id())
        ->whereNotNull('waktu_masuk')
        ->orderBy('waktu_masuk', 'desc')
        ->paginate(5);


        // cek apakah masih ada booking aktif / upcoming
        $hasActiveBooking = $booking->contains(function ($item) {
            return is_null($item->waktu_keluar);
        });
        return view('owner.reservasi.index', compact('booking', 'hasActiveBooking'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kendaraans = Kendaraan::where('user_id', Auth::id())->get();
        $areas = AreaParkir::all();
        return view('owner.reservasi.create', compact('kendaraans', 'areas'));
    }

    /**s
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kendaraan' => 'required|exists:kendaraan,id_kendaraan',
            'id_area' => 'required|exists:area_parkir,id_area',
            'waktu_masuk' => 'required|date_format:Y-m-d\TH:i'
        ]);

        $areaId = $request->id_area;
        $start = $request->waktu_masuk;

        // cek booking aktif
        $hasActiveBooking = Transaksi::where('user_id', Auth::id())
            ->whereNull('waktu_keluar')
            ->exists();

        if ($hasActiveBooking) {
            return back()->with('error', 'Kamu masih punya booking aktif!');
        }

        $area = AreaParkir::findOrFail($areaId);

        $count = Transaksi::where('id_area', $areaId)
            ->whereNull('waktu_keluar')
            ->count();

        if ($count >= $area->kapasitas) {
            return back()->with('error', 'Parkiran sedang penuh!');
        }

        Transaksi::create([
            'id_kendaraan' => $request->id_kendaraan,
            'id_area' => $areaId,
            'user_id' => Auth::id(),
            'waktu_masuk' => $start,
            'status' => 'booking'
        ]);

        $area->increment('terisi');

        return redirect()->route('owner.reservasi.index')
            ->with('success', 'Booking created successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
  public function checkAvailability(Request $request)
    {
        $areaId = $request->area_id;
        $start = $request->waktu_masuk;
        $end = $request->waktu_keluar;

        $area = AreaParkir::findOrFail($areaId);

        // Hitung booking yang overlap
        $count = Transaksi::where('id_area', $areaId)
            ->where(function ($query) use ($start, $end) {
                $query->where('waktu_masuk', '<', $end)
                    ->where('waktu_keluar', '>', $start);
            })
            ->count();

        if ($count >= $area->kapasitas) {
            return response()->json([
                'status' => 'full',
                'message' => 'Parkir penuh di waktu tersebut'
            ]);
        }

        return response()->json([
            'status' => 'available',
            'message' => 'Slot tersedia'
        ]);
    }

    public function cancelBooking($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // pastikan milik user sendiri
        if ($transaksi->user_id != Auth::id()) {
            abort(403);
        }

        if ($transaksi->status != 'booking') {
            return back()->with('error', 'Tidak bisa dibatalkan');
        }

        $area = AreaParkir::findOrFail($transaksi->id_area);

        $transaksi->delete();

        // ✅ balikin slot
        $area->decrement('terisi');

        return back()->with('success', 'Booking berhasil dibatalkan');
    }


}


