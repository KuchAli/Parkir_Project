<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PetugasUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'username' => 'petugas',
            ],
            [
                'nama_lengkap'     => 'Petugas Parkir',
                'username' => 'petugas',
                'password' => Hash::make('petugas123'),
                'role'=> 'petugas',
                'status_aktif' => 1,   
                
            ]
        );
    }
}
