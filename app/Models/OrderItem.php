<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Each OrderItem belongs to a Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Each OrderItem belongs to an Order (optional, but useful)
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
