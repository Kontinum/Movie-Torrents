<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";

    //One comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //One comment belongs to a movie
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
