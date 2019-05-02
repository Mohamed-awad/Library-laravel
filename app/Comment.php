<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function books()
    {
        return $this->belongsTo('App\Book');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
