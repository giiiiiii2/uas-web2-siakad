<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    {{-- Menggunakan CDN Tailwind untuk kesederhanaan, atau pastikan sudah dikompilasi via Vite --}}
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-indigo-600 mb-4">Menu</h2>
                <nav class="space-y-2">
                    {{-- Navigasi Sidebar disesuaikan berdasarkan peran --}}
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="block py-2 px-4 text-gray-700 hover:bg-indigo-100 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-100 font-semibold' : '' }}"><i
                                    class="fas fa-tachometer-alt mr-2"></i>Dashboard Admin</a>
                            <a href="{{ route('admin.users.create') }}"
                                class="block py-2 px-4 text-gray-700 hover:bg-indigo-100 rounded {{ request()->routeIs('admin.users.create') ? 'bg-indigo-100 font-semibold' : '' }}"><i
                                    class="fas fa-user-plus mr-2"></i>Buat Akun</a>
                            <a href="{{ route('admin.users.index') }}"
                                class="block py-2 px-4 text-gray-700 hover:bg-indigo-100 rounded {{ request()->routeIs('admin.users.index') ? 'bg-indigo-100 font-semibold' : '' }}"><i
                                    class="fas fa-users mr-2"></i>Kelola Pengguna</a>
                        @elseif(Auth::user()->role === 'mahasiswa')
                            <a href="{{ route('mahasiswa.dashboard') }}"
                                class="block py-2 px-4 text-gray-700 hover:bg-indigo-100 rounded {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-indigo-100 font-semibold' : '' }}"><i
                                    class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>
                            <a href="{{ route('krs.index') }}"
                                class="block py-2 px-4 text-gray-700 hover:bg-indigo-100 rounded {{ request()->routeIs('krs.index') ? 'bg-indigo-100 font-semibold' : '' }}"><i
                                    class="fas fa-book-open mr-2"></i>KRS</a>
                            <a href="{{ route('khs.index') }}"
                                class="block py-2 px-4 text-gray-700 hover:bg-indigo-100 rounded {{ request()->routeIs('khs.index') ? 'bg-indigo-100 font-semibold' : '' }}"><i
                                    class="fas fa-file-alt mr-2"></i>KHS</a>
                        @elseif(Auth::user()->role === 'dosen')
                            <a href="{{ route('dosen.dashboard') }}"
                                class="block py-2 px-4 text-gray-700 hover:bg-indigo-100 rounded {{ request()->routeIs('dosen.dashboard') ? 'bg-indigo-100 font-semibold' : '' }}"><i
                                    class="fas fa-tachometer-alt mr-2"></i>Dashboard Dosen</a>
                            {{-- Tambahkan link navigasi khusus dosen di sini --}}
                        @endif
                        <a href="{{ route('profile.edit') }}"
                            class="block py-2 px-4 text-gray-700 hover:bg-indigo-100 rounded {{ request()->routeIs('profile.edit') ? 'bg-indigo-100 font-semibold' : '' }}"><i
                                class="fas fa-user mr-2"></i>Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left py-2 px-4 text-red-600 hover:bg-red-100 rounded"><i
                                    class="fas fa-sign-out-alt mr-2"></i>Logout</button>
                        </form>
                    @endauth
                </nav>
            </div>
        </aside>

        <div class="flex-1 flex flex-col">
            <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-bold text-indigo-600">
                    {{-- Judul Navbar disesuaikan --}}
                    @auth
                        @if (Auth::user()->role === 'admin')
                            Dashboard Admin
                        @elseif(Auth::user()->role === 'mahasiswa')
                            Dashboard Mahasiswa
                        @elseif(Auth::user()->role === 'dosen')
                            Dashboard Dosen
                        @else
                            Sistem Informasi Akademik
                        @endif
                    @else
                        Sistem Informasi Akademik
                    @endauth
                </h1>
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="text-right">
                            <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="text-red-500 hover:text-red-700 text-sm">Logout</button>
                        </form>
                    @else
                        {{-- Jika tidak login, tampilkan link login/register jika diperlukan --}}
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login</a>
                        {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-indigo-600 hover:underline">Register</a>
                        @endif --}}
                    @endauth
                </div>
            </nav>

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
