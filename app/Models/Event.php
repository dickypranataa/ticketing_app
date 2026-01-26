<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'tanggal_waktu',
        'lokasi',
        'kategori_id',
        'gambar',
    ];

    protected $casts = [
        'tanggal_waktu' => 'datetime',
    ];

    //1 event bisa memiliki banyak tiket
    public function tikets()
    {
        return $this->hasMany(Tiket::class);
    }

    //1 event hanya memiliki 1 kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    //1 event hanya dibuat oleh 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
