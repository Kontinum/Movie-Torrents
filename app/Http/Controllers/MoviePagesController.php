<?php

namespace App\Http\Controllers;

use App\Actor;
use Illuminate\Http\Request;

class MoviePagesController extends Controller
{
    public function getMovies()
    {
        $count_movies = Actor::all()->count();

        return view('movies')->with('count_movies',$count_movies);
    }
}
