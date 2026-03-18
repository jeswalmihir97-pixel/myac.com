<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name',
        'product_name',
        'product_image',
        'product_size',
        'product_qty',
        'product_details',
        'product_price' ,
       ];
}