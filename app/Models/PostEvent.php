<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostEvent extends Model
{
    use HasFactory;

    protected $table = 'post_event';
    protected $primaryKey = 'id_event';
    public $timestamps = false;

    protected $fillable = [
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'judul_acara',
        'tempat',
        'tanggal_mulai',
        'tanggal_akhir',
        'materi',
        'is_publish',
        'published_at',
        'uuid',
    ];    
}
