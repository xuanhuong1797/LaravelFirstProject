<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
    public function scopeFindProduct($query, $idProduct)
    {
        return $query->where('product_id', $idProduct);
    }
    public function scopeFindByUser($query, $idUser)
    {
        return $query->where('user_id', $idUser);
    }
}
