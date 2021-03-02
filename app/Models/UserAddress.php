<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country',
        'state',
        'city',
        'address',
        'zipcode',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isNotFromAuthenticatedUser()
    {
        return $this->user_id !== auth()->id();
    }
}
