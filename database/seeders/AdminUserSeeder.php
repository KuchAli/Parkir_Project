<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'username' => 'admin',
            ],
            [
                'nama_lengkap'     => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin321'),
                'role'=> 'admin',
                'status_aktif' => 1,   
                
            ]
        );
    }
}
