<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class LaporanController extends Controller
{
   public function index()
    {
        $sortMap = [
            'newest' => ['created_at', 'desc'],
            'oldest' => ['created_at', 'asc'],
        ];

        $query = Transaksi::with('user');

        // SEARCH
        if (request()->has('search') && request('search') != '') {
            $search = request('search');

            $query->whereHas('user', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%")
                ->orWhere('username', 'like', "%$search%");
            });
        }

        // SORT
        if (request()->has('sort') && isset($sortMap[request('sort')])) {
            $query->orderBy(...$sortMap[request('sort')]);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $logs = $query->paginate(3)->withQueryString();

        return view('admin.logs.index', compact('logs'));
    }

   



}
