<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\KrsController;
use App\Http\Controllers\Mahasiswa\KhsController;
use App\Http\Controllers\Admin\UserController; // Tambahkan ini

Route::middleware(['auth'])->group(function () {
    Route::get('/mahasiswa/krs', [KrsController::class, 'index'])->name('krs.index');
    Route::get('/mahasiswa/krs/create', [KrsController::class, 'create'])->name('krs.create');
    Route::post('/mahasiswa/krs/store', [KrsController::class, 'store'])->name('krs.store');
    Route::get('/mahasiswa/krs/{krs}/edit', [KrsController::class, 'edit'])->name('krs.edit');
    Route::put('/mahasiswa/krs/{krs}', [KrsController::class, 'update'])->name('krs.update');
    Route::delete('/mahasiswa/krs/delete/{id}', [KrsController::class, 'destroy'])->name('krs.destroy');
    Route::post('/mahasiswa/krs/simpan', [KrsController::class, 'simpanKrs'])->name('krs.simpan');
    Route::get('/mahasiswa/khs', [App\Http\Controllers\Mahasiswa\KhsController::class, 'index'])->name('khs.index');
});

Route::get('/mahasiswa/krs/pilih', [KrsController::class, 'pilihMatakuliah'])->name('mahasiswa.krs.pilih');
Route::post('/mahasiswa/krs/simpan', [KrsController::class, 'simpanKrs'])->name('mahasiswa.krs.simpan');
Route::get('/mahasiswa/khs/cetak', [KhsController::class, 'cetakKhs'])->name('mahasiswa.khs.cetak');
Route::get('/mahasiswa/krs/cetak', [KrsController::class, 'cetakKrs'])->name('mahasiswa.krs.cetak');
Route::get('/mahasiswa/krs/preview', [KrsController::class, 'previewKrs'])->name('mahasiswa.krs.preview');
Route::get('/mahasiswa/krs/preview/{id}', [KrsController::class, 'previewKrs'])->name('mahasiswa.krs.preview');
Route::get('/mahasiswa/krs/preview/{id}/cetak', [KrsController::class, 'cetakKrs'])->name('mahasiswa.krs.preview.cetak');

Route::get('/', function () {
    return view('welcome');
});

// Hapus atau komentari rute dashboard default ini jika Anda ingin setiap role memiliki dashboard spesifik
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute khusus untuk Mahasiswa
Route::middleware(['auth', 'mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');
});

// Rute khusus untuk Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Anda perlu membuat view ini
    })->name('dashboard');

    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // Tambahkan rute lain untuk pengelolaan user oleh admin (edit, delete)
});

// Rute khusus untuk Dosen (Anda perlu membuat middleware 'dosen' jika belum ada)
// dan membuat controller serta view untuk dashboard dosen
Route::middleware(['auth', 'dosen'])->group(function () {
    Route::get('/dashboard-dosen', function () {
        return view('dosen.dashboard'); // Anda perlu membuat view ini
    })->name('dosen.dashboard');
    // Tambahkan rute lain untuk dosen di sini
});


require __DIR__ . '/auth.php';
