<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Krs;

class KhsController extends Controller
{
    public function index()
    {
        $krs = Krs::where('user_id', Auth::id())->get();

        // Mapping ke bentuk KHS (sementara nilai bisa diisi dummy)
        $khs = $krs->map(function ($item) {
            return [
                'mata_kuliah' => $item->mata_kuliah,
                'sks' => $item->sks,
                'semester' => $item->semester,
                'nilai' => 'A', // Atau ambil dari tabel nilai jika tersedia
            ];
        });

        return view('mahasiswa.khs.index', compact('khs'));
    }
}
