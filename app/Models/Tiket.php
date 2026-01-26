<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'tipe',
        'harga',
        'stok',
    ];

    //1 tiket hanya untuk 1 event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    //1 tiket bisa terdapat di banyak detail order
    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class);
    }

    //1 tiket bisa terdapat di banyak order melalui detail order
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'detail_orders')->withPivot('jumlah', 'subtotal_harga');
    }
}
