<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'username'
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            if ($model->gender == 0) {
                $model->avatar_url =  'images/avatar/default-avatar-male.jpeg';
            } else {
                $model->avatar_url =  'images/avatar/default-avatar-female.jpeg';
            }
            $model->assignRole('user');
            $model->save();
        });
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','updated_at'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }

    public function love()
    {
        return $this->hasMany(Love::class, 'user_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'user_id', 'id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'leader_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'leader_id');
    }
}
