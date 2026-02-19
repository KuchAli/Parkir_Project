<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PetugasMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'petugas') {
            return match (Auth::user()->role) {
                'admin'   => redirect('/admin/dashboard'),
                'owner'   => redirect('/owner/dashboard'),
                default   => abort(403), // atau redirect('/login')
            };
        }

        return $next($request);
    }
}
