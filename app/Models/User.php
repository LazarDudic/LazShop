<?php

namespace App\Models;

use App\Traits\Permissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Permissions, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function isNotAuthenticated()
    {
        return $this->id !== auth()->id();
    }

    public function hasOngoingOrder()
    {
        return $this->orders->contains(function($value, $key) {
            return in_array($value->status , ['paid', 'shipped', 'dispute']);
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isEntitledToLeaveReview(Product $product): bool
    {
        if (! $this->hasRole('buyer')) {
            return false;
        }
        return (boolean) $this->reviews()->where('product_id', $product->id)->count();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function wishListProducts()
    {
        return $this->belongsToMany(Product::class, 'wish_lists');
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class);
    }
}
