<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = "pictures";

    //One picture belongs to a movie
    public function movies()
    {
        return $this->belongsTo(Movie::class);
    }
}
