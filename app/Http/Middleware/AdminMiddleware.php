<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response; // Tambahkan ini

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response // Tambahkan : Response
    {
        if (Auth::check() && Auth::user()->role === 'admin') { // Pastikan Auth::check() ada di sini
            return $next($request);
        }

        // Jika tidak admin atau tidak login, redirect ke halaman login atau tampilkan error
        return redirect('/login')->withErrors(['role' => 'Akses khusus untuk admin.']); // Redirect ke login dengan pesan
    }
}
