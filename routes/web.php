<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\KrsController;
use App\Http\Controllers\Mahasiswa\KhsController;

Route::middleware(['auth'])->group(function () {
    Route::get('/mahasiswa/krs', [KrsController::class, 'index'])->name('krs.index');
    Route::get('/mahasiswa/krs/create', [KrsController::class, 'create'])->name('krs.create');
    Route::post('/mahasiswa/krs/store', [KrsController::class, 'store'])->name('krs.store');
    Route::get('/mahasiswa/krs/{krs}/edit', [KrsController::class, 'edit'])->name('krs.edit');
    Route::put('/mahasiswa/krs/{krs}', [KrsController::class, 'update'])->name('krs.update');
    Route::delete('/mahasiswa/krs/delete/{id}', [KrsController::class, 'destroy'])->name('krs.destroy');
    Route::post('/mahasiswa/krs/simpan', [KrsController::class, 'simpanKrs'])->name('krs.simpan');
    Route::get('/mahasiswa/khs', [App\Http\Controllers\Mahasiswa\KhsController::class, 'index'])->name('khs.index');
    // Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');
});


require __DIR__.'/auth.php';
