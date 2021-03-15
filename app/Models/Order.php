<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'subtotal',
        'tax',
        'shipping',
        'status',
        'first_name',
        'last_name',
        'email',
        'transaction_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orderItemsAndRelatedProduct()
    {
        return $this->hasMany(OrderItem::class)->with('product');
    }

    public function address()
    {
        return $this->hasOne(OrderAddress::class);
    }
}
