<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostBerita extends Model
{
    use HasFactory;

    protected $table = 'post_berita';
    protected $primaryKey = 'id_berita';
    public $timestamps = false;

    protected $fillable = [
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'judul',
        'konten',
        'deskripsi',
        'kategori',
        'thumbnail',
        'teks_thumbnail',
        'is_publish',
        'published_at',
        'uuid',
    ];     
}
