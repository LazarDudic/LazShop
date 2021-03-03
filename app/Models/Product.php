<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'price',
        'image',
        'category_id',
        'created_by',
        'updated_by'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function updatedAt()
    {
        if ($this->created_at != $this->updated_at) {
            return $this->updated_at;
        }

        return null;
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->created_by = auth()->id();
            $product->updated_by = auth()->id();
        });

        static::saving(function ($product) {
            $product->updated_by = auth()->id();
        });

        static::updating(function ($product) {
            $product->updated_by = auth()->id();
        });
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value === 'on');
    }

    public function deleteImage()
    {
        Storage::delete('/public/'.$this->image);
    }
}
