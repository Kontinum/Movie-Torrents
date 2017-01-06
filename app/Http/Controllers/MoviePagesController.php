<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Genre;
use App\Http\Requests\AddMovieFormRequest;
use App\Movie;
use App\Picture;
use App\Torrent;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MoviePagesController extends Controller
{
    public function getMovies()
    {
        $count_movies = Movie::all()->count();
        $genres = Genre::all();
        $actors = Actor::all();

        return view('movies')->with('count_movies',$count_movies)->with('genres',$genres)->with('actors',$actors);
    }

    public function postMovie(AddMovieFormRequest $request)
    {
        $movie = Movie::where('name',$request['movie_name'])->where('year',$request['movie_year'])->first();

        if($movie){
            return redirect()->back()->with(['fail'=>'Movie with name '.$movie->name .' is already in database']);
        }

        //add movie
        $movie = new Movie();
        $movie->name = $request->movie_name;
        $movie->year = $request->movie_year;
        $movie->director = $request->movie_director;
        $movie->youtube_trailer = $request->youtube_trailer;
        $movie->imdb_rating = $request->imdb_rating;
        $movie->synopsis = $request->movie_synopsis;
        $movie->save();

        //add genres for movie
        $movie->genres()->attach($request->genres);

        //add actors and their roles for movie
        $actors_id = array($request->movie_actor_1,$request->movie_actor_2,$request->movie_actor_3,$request->movie_actor_4);
        $actors_roles = array($request->actor_1_role,$request->actor_2_role,$request->actor_3_role,$request->actor_4_role);

        for($i=0;$i<count($actors_id);$i++){
            $movie->actors()->attach($actors_id[$i],['plays'=>$actors_roles[$i]]);
        }

        //add pictures for movie
        mkdir(public_path().'/images/movies/'.$request->movie_name.'-'.$request->movie_year);
        $images_path = public_path().'/images/movies/'.$request->movie_name.'-'.$request->movie_year.'/';

        $poster_image = $request->file('poster_image');
        $poster_name = $poster_image->getClientOriginalName();
        Image::make($poster_image)->resize(280,410)->save($images_path . $poster_name);

        $screenshot1_image = $request->file('screenshot1_image');
        $screenshot1_name = $screenshot1_image->getClientOriginalName();
        Image::make($screenshot1_image)->resize(1280,680)->save($images_path . $screenshot1_name);

        $screenshot2_image = $request->file('screenshot2_image');
        $screenshot2_name = $screenshot2_image->getClientOriginalName();
        Image::make($screenshot2_image)->resize(1280,680)->save($images_path . $screenshot2_name);

        $picture = new Picture();

        $picture->poster_picture = $poster_name;
        $picture->screenshot1 = $screenshot1_name;
        $picture->screenshot2 = $screenshot2_name;

        $movie->pictures()->save($picture);

        //add torrent information for movie
        $torrent = new Torrent();

        $torrent->size = $request->movie_size;
        $torrent->resolution = $request->movie_resolution;
        $torrent->audio = $request->movie_audio;
        $torrent->length = $request->movie_length;
        $torrent->fps = $request->movie_fps;
        $torrent->pg = $request->movie_pg;

        $movie->torrent()->save($torrent);
    }
}
