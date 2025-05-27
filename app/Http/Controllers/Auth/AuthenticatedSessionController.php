<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Menangani proses login.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'role' => ['required', 'string'],
        ]);

        $credentials = $request->only('email', 'password');
        $role = $request->input('role');

        // Ambil user berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        // Cek apakah user ada dan password cocok
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => __('Email atau password salah.'),
            ]);
        }

        // Cek apakah role yang dipilih sesuai dengan role user di database
        if ($user->role !== $role) {
            throw ValidationException::withMessages([
                'role' => __('Peran tidak sesuai dengan akun yang terdaftar.'),
            ]);
        }

        // Login user
        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        // Redirect secara eksplisit sesuai role
        if ($user->role === 'mahasiswa') {
            return redirect('/mahasiswa/dashboard'); // Ubah dari intended() ke direct redirect
        } elseif ($user->role === 'dosen') {
            return redirect('/dashboard-dosen'); // Ubah dari intended() ke direct redirect
        } elseif ($user->role === 'admin') {
            return redirect('/admin/dashboard'); // Ubah dari intended() ke direct redirect
        }

        // Fallback jika tidak ada role yang cocok (seharusnya tidak terjadi jika validasi role sudah ketat)
        return redirect('/'); // Tetap redirect ke halaman utama jika tidak ada role yang cocok
    }

    /**
     * Logout user.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login'); // Pastikan ini mengarahkan ke halaman login setelah logout
    }
}
