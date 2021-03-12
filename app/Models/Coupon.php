<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'amount',
        'expiry_date',
    ];

    public function discount()
    {
        if ($this->type === 'percent') {
            return Cart::subtotal() * ($this->amount / 100);
        }

        return Cart::subtotal() - $this->amount;
    }
}
