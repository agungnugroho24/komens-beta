<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostRFC extends Model
{
    use HasFactory;

    protected $table = 'post_rfc';
    protected $primaryKey = 'id_rfc';
    public $timestamps = false;

    protected $fillable = [
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'judul',
        'konten',
        'kategori',
        'is_publish',
        'published_at',
        'uuid',
    ];      
}
