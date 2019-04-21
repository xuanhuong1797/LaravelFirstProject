<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /**
     * All related wards
     *
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wards()
    {
        return $this->hasMany(Ward::class);
    }

    /**
     * Get province belonged to
     *
      *  @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
