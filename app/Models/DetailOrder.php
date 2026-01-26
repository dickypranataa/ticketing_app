<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'tiket_id',
        'jumlah',
        'subtotal_harga',
    ];

    //1 detail order hanya untuk 1 order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    //1 detail order hanya untuk 1 tiket
    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }
}
