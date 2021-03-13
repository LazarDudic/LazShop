<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_id',
        'unit_price',
        'order_id',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
