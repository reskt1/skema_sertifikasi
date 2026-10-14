<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // memeriksa apakah sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        //memeriksa apakah role sebagai admin atau user
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'Anda tidak memiliki hak akses.');
    }
}
