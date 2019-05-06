<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract
{
    use Notifiable, HasApiTokens, Authenticatable, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','userName','phone','SSN'
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
    public function leases()
    {
        return $this->belongsToMany('App\Book', 'book_leaseds');
    }
    public function favourites()
    {
        return $this->belongsToMany('App\Book','book_favourites');
    }
    public function rates()
    {
        return $this->belongsToMany('App\Book', 'book_rates');
    }
    public function isAdmin(){
        if($this->isAdmin == 1){
            return true;
        } else {
            return false;
        }
    }
}
