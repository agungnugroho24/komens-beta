<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLayanan extends Model
{
    use HasFactory;

    protected $table = 'post_layanan';
    protected $primaryKey = 'id_layanan';
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
        'logo',
    ];     
}
