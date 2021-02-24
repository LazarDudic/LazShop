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

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value === 'on');
    }

    public function deleteImage()
    {
        Storage::delete('/public/'.$this->image);
    }
}
