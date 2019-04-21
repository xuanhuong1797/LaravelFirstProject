<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Love extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'loved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function scopeLoved($query, $idProduct, $idUser)
    {
        return $query->where(['product_id' => $idProduct, 'user_id' => $idUser]);
    }
}
