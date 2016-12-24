<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //One role belongs to many users
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
