<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'mata_kuliah', 'sks', 'semester','mata_kuliah_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
  public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'mata_kuliah_id'); // atau 'mata_kuliah' tergantung kolomnya
    }
}
