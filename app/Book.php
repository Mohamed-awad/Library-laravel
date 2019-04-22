<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function users_leased()
    {
        return $this->belongsToMany(Role::class, 'book_leaseds');
    }
    public function users_favourite()
    {
        return $this->belongsToMany(Role::class, 'book_favourites');
    }
    public function users_rate()
    {
        return $this->belongsToMany(Role::class, 'book_rates');
    }
   
}
