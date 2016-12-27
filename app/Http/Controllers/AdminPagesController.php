<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

class AdminPagesController extends Controller
{
    //Return all genres order by name
    public function getGenres()
    {
        $genres = Genre::all()->orderBy('name','ASC')->get();

        return view('genres')->with('genres',$genres);
    }
}
