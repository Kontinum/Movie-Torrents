<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Torrent extends Model
{
    protected $table = "torrents";

    //Torrent belongs to a movie
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
