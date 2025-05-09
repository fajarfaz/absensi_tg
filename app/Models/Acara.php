<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'image',
        'deskripsi',
        'start_time',
        'end_time',
        'slug',
        'call_to_actions', // Tambahkan kolom ini
    ];

    protected $casts = [
        'call_to_actions' => 'array', // Ubah ke array saat diambil
    ];
}
