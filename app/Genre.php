<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = "genres";

    protected $fillable = [
        'name'
    ];

    //One genre belongs to many movies
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
