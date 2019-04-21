<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    protected $fillable = [
        'product_id',
        'image_url',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function scopeFindProduct($query, $idProduct)
    {
        return $query->where('product_id', $idProduct);
    }
}
