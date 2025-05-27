<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response; // Tambahkan ini

class MahasiswaMiddleware
{
    public function handle(Request $request, Closure $next): Response // Tambahkan : Response
    {
        if (Auth::check() && Auth::user()->role === 'mahasiswa') { // Pastikan Auth::check() ada di sini
            return $next($request);
        }

        // Jika tidak mahasiswa atau tidak login, redirect ke halaman login atau tampilkan error
        return redirect('/login')->withErrors(['role' => 'Akses khusus untuk mahasiswa']); // Redirect ke login dengan pesan
    }
}