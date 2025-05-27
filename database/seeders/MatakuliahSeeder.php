<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matakuliah;

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        Matakuliah::create(['kode' => 'IF101', 'nama' => 'Pemrograman Dasar', 'sks' => 3]);
        Matakuliah::create(['kode' => 'IF102', 'nama' => 'Basis Data', 'sks' => 3]);
        Matakuliah::create(['kode' => 'IF103', 'nama' => 'Algoritma', 'sks' => 2]);
    }
}
