<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    //1 kategori bisa terdapat di banyak event
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
