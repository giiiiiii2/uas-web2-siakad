<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

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

        if (!$user || !\Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => __('Email atau password salah.'),
            ]);
        }

        // Cek apakah role sesuai
        if ($user->role !== $role) {
            throw ValidationException::withMessages([
                'role' => __('Peran tidak sesuai.'),
            ]);
        }

        // Login user
        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        // Redirect sesuai role
        if ($user->role === 'mahasiswa') {
            return redirect()->intended('/dashboard-mahasiswa');
        } elseif ($user->role === 'dosen') {
            return redirect()->intended('/dashboard-dosen');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Logout user.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
