<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah'; // ← ini wajib agar pakai nama tabel yang benar

    protected $fillable = ['kode', 'nama', 'sks'];
}
