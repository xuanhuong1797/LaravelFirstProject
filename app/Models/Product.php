<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cocur\Slugify\Slugify;

class Product extends Model
{
    protected $fillable = [
        'name',
        'address',
        'price',
        'description',
        'category_id',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $slugable = new Slugify();
            $model->slug = $slugable->slugify($model->name . ' ' . $model->id);
            $model->save();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function image()
    {
        return $this->hasMany(ImageProduct::class, 'product_id', 'id');
    }

    public function love()
    {
        return $this->hasMany(Love::class, 'product_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'product_id', 'id');
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
