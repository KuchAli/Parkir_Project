<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AreaParkir;
use App\Models\Tarif;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'id_kendaraan',
        'waktu_masuk',
        'waktu_keluar',
        'id_tarif',
        'durasi_jam',
        'biaya_total',
        'status',
        'user_id',
        'id_area',
    ];

    // Relasi dengan User, AreaParkir, dan Tarif
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function area()
    {
        return $this->belongsTo(AreaParkir::class, 'id_area');
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif');
    }
}
