<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cocur\Slugify\Slugify;

class Category extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $slugable = new Slugify();
            $model->slug = $slugable->slugify($model->name);
            $model->save();
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function productPublished()
    {
        return $this->products()->published();
    }
}
