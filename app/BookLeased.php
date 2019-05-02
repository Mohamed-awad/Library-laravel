<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookLeased extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User');
    }
    public function books()
    {
        return $this->belongsTo('App\Book');
    }
}
