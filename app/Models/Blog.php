<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'call_to_action',
        'is_published',
        'banner_image',
    ];

    protected $casts = [
        'call_to_action' => 'array', // Cast ke array agar lebih mudah ditangani
    ];

    // Setter otomatis untuk slug saat menyimpan judul
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = \Str::slug($value); // Menghasilkan slug dari judul
    }
}

