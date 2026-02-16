<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'aktivitas' => 'required|string',
            'waktu_aktivitas' => 'required|date',
        ]);
    }
}
