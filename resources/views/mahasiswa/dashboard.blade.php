<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex">

    <aside class="w-64 bg-white shadow-md hidden md:block">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-indigo-600 mb-4">Menu</h2>
            <nav class="space-y-2">
                <a href="{{ route('mahasiswa.dashboard') }}"
                    class="block py-2 px-4 text-gray-700 hover:bg-indigo-100 rounded {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-indigo-100 font-semibold' : '' }}"><i
                        class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>
                <a href="{{ route('profile.edit') }}"
                    class="block py-2 px-4 text-gray-700 hover:bg-indigo-100 rounded {{ request()->routeIs('profile.edit') ? 'bg-indigo-100 font-semibold' : '' }}"><i
                        class="fas fa-user mr-2"></i>Profil</a>
                <a href="{{ route('krs.index') }}"
                    class="block py-2 px-4 text-gray-700 hover:bg-indigo-100 rounded {{ request()->routeIs('krs.index') ? 'bg-indigo-100 font-semibold' : '' }}"><i
                        class="fas fa-book-open mr-2"></i>KRS</a>
                <a href="{{ route('khs.index') }}"
                    class="block py-2 px-4 text-gray-700 hover:bg-indigo-100 rounded {{ request()->routeIs('khs.index') ? 'bg-indigo-100 font-semibold' : '' }}"><i
                        class="fas fa-file-alt mr-2"></i>KHS</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 px-4 text-red-600 hover:bg-red-100 rounded"><i
                            class="fas fa-sign-out-alt mr-2"></i>Logout</button>
                </form>
            </nav>
        </div>
    </aside>

    <div class="flex-1 flex flex-col">
        <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-indigo-600">Dashboard Mahasiswa</h1>
            <div class="flex items-center space-x-4">
                <div class="text-right">
                    <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 hover:text-red-700 text-sm">Logout</button>
                </form>
            </div>
        </nav>

        <main class="p-6 space-y-6">
            <h2 class="text-2xl font-semibold text-gray-800">Selamat datang, {{ Auth::user()->name }}!</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white shadow rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Status Akademik</p>
                            <p class="text-xl font-bold text-indigo-600">Aktif</p>
                        </div>
                        <i class="fas fa-user-graduate text-indigo-400 text-2xl"></i>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Email</p>
                            <p class="text-xl font-bold">{{ Auth::user()->email }}</p>
                        </div>
                        <i class="fas fa-envelope text-green-400 text-2xl"></i>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Peran</p>
                            <p class="text-xl font-bold text-yellow-600">{{ ucfirst(Auth::user()->role) }}</p>
                        </div>
                        <i class="fas fa-user-tag text-yellow-400 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('krs.index') }}"
                        class="bg-blue-500 text-white p-4 rounded-lg shadow hover:bg-blue-600 transition duration-200 flex items-center justify-center text-center">
                        <i class="fas fa-book-open text-2xl mr-2"></i>
                        <span>Lihat KRS</span>
                    </a>
                    <a href="{{ route('khs.index') }}"
                        class="bg-green-500 text-white p-4 rounded-lg shadow hover:bg-green-600 transition duration-200 flex items-center justify-center text-center">
                        <i class="fas fa-file-alt text-2xl mr-2"></i>
                        <span>Lihat KHS</span>
                    </a>
                    <a href="{{ route('profile.edit') }}"
                        class="bg-purple-500 text-white p-4 rounded-lg shadow hover:bg-purple-600 transition duration-200 flex items-center justify-center text-center">
                        <i class="fas fa-user-circle text-2xl mr-2"></i>
                        <span>Edit Profil</span>
                    </a>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
