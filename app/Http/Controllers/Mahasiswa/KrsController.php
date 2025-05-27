<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Krs;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    public function index()
    {
        $krs = Krs::where('user_id', Auth::id())->get();
        return view('mahasiswa.krs.index', compact('krs'));
    }

    public function create()
    {
        // Ambil semua matakuliah yang sudah dipilih oleh user
        $sudahDipilih = Krs::where('user_id', Auth::id())->pluck('mata_kuliah_id');

        // Ambil matakuliah yang belum dipilih
        $matakuliah = Matakuliah::whereNotIn('id', $sudahDipilih)->get();

        return view('mahasiswa.krs.create', compact('matakuliah'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|array',
            'mata_kuliah_id.*' => 'exists:matakuliah,id',
        ]);

        foreach ($request->mata_kuliah_id as $id) {
            $sudahAda = Krs::where('user_id', Auth::id())
                            ->where('mata_kuliah_id', $id)
                            ->exists();

            if (!$sudahAda) {
                $matkul = Matakuliah::find($id);
                Krs::create([
                    'user_id' => Auth::id(),
                    'mata_kuliah_id' => $matkul->id,
                    'mata_kuliah' => $matkul->nama,
                    'sks' => $matkul->sks,
                    'semester' => 'Genap',
                ]);
            }
        }

        return redirect()->route('krs.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }




    public function edit(Krs $krs)
    {
        $matakuliah = Matakuliah::all(); // Jika ingin ubah pilihan matkul
        return view('mahasiswa.krs.edit', compact('krs', 'matakuliah'));
    }

    public function update(Request $request, Krs $krs)
    {
        $request->validate([
            'mata_kuliah' => 'required|string|max:255',
            'sks' => 'required|numeric',
            'semester' => 'required|string|max:10',
        ]);

        $krs->update([
            'mata_kuliah' => $request->mata_kuliah,
            'sks' => $request->sks,
            'semester' => $request->semester,
        ]);

        return redirect()->route('krs.index')->with('success', 'Data KRS berhasil diupdate.');
    }
   public function destroy($id)
    {
        $krs = Krs::find($id);
        if ($krs) {
            $krs->delete(); // Hapus dari database
            return redirect()->route('krs.index')->with('success', 'Data KRS berhasil dihapus.');
        } else {
            return redirect()->route('krs.index')->with('error', 'Data tidak ditemukan.');
        }
    }



    public function simpanKrs(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|exists:matakuliah,id',
        ]);

        $matkul = Matakuliah::findOrFail($request->mata_kuliah_id);

        Krs::create([
            'user_id' => Auth::id(),
            'mata_kuliah_id' => $matkul->id,
            'mata_kuliah' => $matkul->nama,
            'sks' => $matkul->sks,
            'semester' => 'Genap',
        ]);

        return redirect()->route('krs.index')->with('success', 'Mata kuliah berhasil diambil.');
    }
}