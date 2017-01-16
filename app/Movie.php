<?php

namespace App;

use Carbon\Carbon;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = "movies";

    public function getCreatedAtAttribute($value)
    {
       $date = Carbon::parse($value);
       return $date->format('d-m-Y');
    }

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
