<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'address',
        'ward_id',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
