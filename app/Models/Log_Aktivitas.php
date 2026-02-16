<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Log_Ativitas extends Model
{
    protected $fillable = [
        'id_user',
        'aktivitas',
        'waktu_aktivitas',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
