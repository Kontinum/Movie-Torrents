<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = "movies";

    //One movie has one torrent
    public function torrent()
    {
        return $this->hasOne(Torrent::class);
    }

    //One movie has many pictures
    public function pictures()
    {
        return $this->hasOne(Picture::class);
    }

    //One movie belongs to many genres
    public function genres()
    {
        return $this->belongsToMany(Genre::class)->withTimestamps();
    }

    //One movie has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //One movie belongs to many actors
    public function actors()
    {
        return $this->belongsToMany(Actor::class)->withPivot('plays')->withTimestamps();
    }
}
