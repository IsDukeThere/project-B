<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'tanggal',
        'jam',
        'kuota',
        'biaya',
        'deskripsi',
        'registration_link',
        'image'
    ];
}
