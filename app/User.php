<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function books_leased()
    {
        return $this->belongsToMany(Role::class, 'book_leaseds');
    }
    public function books_favourite()
    {
        return $this->belongsToMany(Role::class, 'book_favourites');
    }
    public function books_rate()
    {
        return $this->belongsToMany(Role::class, 'book_rates');
    }
}
