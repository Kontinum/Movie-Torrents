<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $table = "actors";

    //One actor belongs to many movies
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
