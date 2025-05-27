<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mata_kuliah',
        'sks',
        'semester',
        'nilai',
    ];
}
