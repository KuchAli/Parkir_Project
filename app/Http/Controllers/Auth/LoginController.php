<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

       
        if (Auth::attempt([
            'username' => trim($request->username),
            'password' => trim($request->password),
            'status_aktif' => 1

        ])) {
            $request->session()->regenerate();

            return match (Auth::user()->role) {
                'admin'  => redirect('/admin/dashboard'),
                'petugas' => redirect('/petugas/dashboard'),
                'owner'   => redirect('/owner/dashboard'),
            };
        }

        return back()->withErrors([
            'login' => 'Username / Email atau Password salah'
        ]);
    }
}
