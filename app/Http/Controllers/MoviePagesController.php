<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Genre;
use App\Movie;
use Illuminate\Http\Request;

class MoviePagesController extends Controller
{
    public function getMovies()
    {
        $count_movies = Movie::all()->count();
        $genres = Genre::all();
        $actors = Actor::all();

        return view('movies')->with('count_movies',$count_movies)->with('genres',$genres)->with('actors',$actors);
    }
}
