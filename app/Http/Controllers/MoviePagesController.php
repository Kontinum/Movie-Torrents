<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Movie;
use Illuminate\Http\Request;

class MoviePagesController extends Controller
{
    public function getMovies()
    {
        $count_movies = Movie::all()->count();

        return view('movies')->with('count_movies',$count_movies);
    }
}
