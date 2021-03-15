<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table = 'shipping';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'order_address_id',
        'shipped_at',
        'deliver_at'
    ];

    public function getShippedAtAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }

        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getDeliverAtAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }

        return Carbon::parse($value)->format('Y-m-d');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orderAddress()
    {
        return $this->belongsTo(OrderAddress::class);
    }
}
