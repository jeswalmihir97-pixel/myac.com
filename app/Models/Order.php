<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'address', 'total', 'payment_method', 'status', 'delivery_date'
    ];

    // Cast date fields to Carbon
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'delivery_date' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }
}
