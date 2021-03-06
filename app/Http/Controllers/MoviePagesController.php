<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Genre;
use App\Http\Requests\AddMovieFormRequest;
use App\Http\Requests\EditMovieFormRequest;
use App\Mail\NewMovieMail;
use App\Movie;
use App\Picture;
use App\Torrent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MoviePagesController extends Controller
{

    public function home()
    {
        $popular_movies = Movie::orderBy('downloaded','DESC')->limit(4)->get();
        $new_movies = Movie::orderBy('created_at','DESC')->limit(4)->get();

       return view('home')->with('popular_movies',$popular_movies)->with('new_movies',$new_movies);
    }

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
        $actors_id = array_unique([$request->movie_actor_1,$request->movie_actor_2,$request->movie_actor_3,$request->movie_actor_4]);
        if(count($actors_id) < 4){
            return redirect()->back()->with(['fail'=>'Actors must be different']);
        }
        $actors_roles = array($request->actor_1_role,$request->actor_2_role,$request->actor_3_role,$request->actor_4_role);

        for($i=0;$i<count($actors_id);$i++){
            $movie->actors()->attach($actors_id[$i],['plays'=>$actors_roles[$i]]);
        }

        //add pictures for movie
        $picture = $this->addPictures($request);

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

        Mail::to('admins@movieTorrents.com')->send(new NewMovieMail($movie));

        return redirect()->route('getMovies')->with(['success'=>'Movie '.$request->movie_name.' has been successfully added']);
    }

    //Search movies
    public function getSearchMovies(Request $request)
    {
        $this->validate($request, [
            'movie_name'=>'required'
        ]);
        $movies = Movie::where('name','like', '%'.$request->movie_name.'%')->get();

        if($movies->isEmpty()){
            return redirect()->back()->with(['fail'=>'There is no movie with '.$request->movie_name.' search term']);
        }

        $search_term = $request->movie_name;

        return view('searchMovies')->with('movies',$movies)->with('search_term',$search_term);
    }

    //Delete movie
    public function deleteMovie($movie_id)
    {
        $movie = Movie::find($movie_id);

        if(!$movie){
            return redirect()->route('getMovies')->with(['fail'=>'That movie is not in database']);
        }

        Storage::deleteDirectory('/images/movies/'.$movie->pictures->images_directory_name);

        $movie->delete();

        return redirect()->route('getMovies')->with(['success'=>'Movie '.$movie->name.' has been successfully deleted']);
    }

    //Movie by letter
    public function letterMovies($letter)
    {
        if($letter == '0-9'){
            $movies = Movie::where('name','REGEXP','^[0-9]')->get();
        }else {
            $movies = Movie::where('name', 'like', $letter . '%')->get();
        }

        if($movies->isEmpty()){
            return redirect()->route('getMovies')->with(['fail'=>'There are no movies that name begin with '.$letter]);
        }

        return view('letterMovies')->with('movies',$movies)->with('letter',$letter);
    }

    //Display form for movie editing
    public function getEditMovie($movie_id)
    {
        $movie = Movie::find($movie_id);

        if(!$movie){
            return redirect()->route('getMovies')->with(['fail'=>'There is no movie with that name in database']);
        }

        $genres = Genre::all();
        $actors = Actor::all();
        $movie_actors = $movie->actors()->get();

        return view('editMovie')->with('movie',$movie)->with('genres',$genres)->with('actors',$actors)->with('movie_actors',$movie_actors);
    }

    //Edit movie
    public function postEditMovie(EditMovieFormRequest $request)
    {
       $movie = Movie::find($request->movie_id);

        if(!$movie){
            return redirect()->route('getMovies')->with(['fail'=>'That movie is no longer in database']);
        }
        //changing directory name if movie name or movie year was edited
        $movie_name = $this->removeForbiddenDirectoryCharacters($request->movie_name);
        if($movie->name !== $request->movie_name || ''.$movie->year.'' !== $request->movie_year){
            Storage::move('/images/movies/'.$movie->pictures->images_directory_name,'/images/movies/'.$movie_name.'-'.$request->movie_year);
        }

        //add movie
        $movie->name = $request->movie_name;
        $movie->year = $request->movie_year;
        $movie->director = $request->movie_director;
        $movie->youtube_trailer = $request->youtube_trailer;
        $movie->imdb_rating = $request->imdb_rating;
        $movie->synopsis = $request->movie_synopsis;
        $movie->save();

        //edit genres
        $movie->genres()->sync($request->genres);

        //edit actors and their roles for movie and check is there actors with the same id
        $actors_id = array_unique([$request->movie_actor_1,$request->movie_actor_2,$request->movie_actor_3,$request->movie_actor_4]);
        if(count($actors_id) < 4){
            return redirect()->back()->with(['fail'=>'Actors must be different']);
        }
        $actors_roles = array($request->actor_1_role,$request->actor_2_role,$request->actor_3_role,$request->actor_4_role);

        //Sync actors and their roles
        $movie->actors()->sync([$actors_id[0]=>['plays'=>$actors_roles[0]],$actors_id[1]=>['plays'=>$actors_roles[1]],$actors_id[2]=>['plays'=>$actors_roles[2]],$actors_id[3]=>['plays'=>$actors_roles[3]]]);

        //edit pictures if exists
        $picture = Picture::where('movie_id',$request->movie_id)->first();
        $picture = $this->editPictures($request,$movie,$picture,$movie_name);
        $movie->pictures()->save($picture);

        //edit Torrent information
        $torrent = Torrent::where('movie_id',$request->movie_id)->first();

        $torrent->size = $request->movie_size;
        $torrent->resolution = $request->movie_resolution;
        $torrent->audio = $request->movie_audio;
        $torrent->length = $request->movie_length;
        $torrent->fps = $request->movie_fps;
        $torrent->pg = $request->movie_pg;

        $movie->torrent()->save($torrent);

        return redirect()->back()->with(['success'=>'Movie '.$request->movie_name.' has been successfully edited']);
    }

    //browse a single movie if an id is given otherwise browse all movies
    public function browseMovies($movie_id = null)
    {
        if($movie_id){
            $movie = Movie::find($movie_id);

            if(!$movie){
                return redirect()->route('home')->with(['fail'=>'That movie is no longer available']);
            }

            $genres = $movie->genres;

            $comments = $movie->comments()->orderBy('created_at','DESC')->limit(5)->get();

            $recommended_movies = Movie::where('id','<>',$movie->id)->limit(4)->get();

            return view('browseMovie')->with('movie',$movie)->with('genres',$genres)->with('comments',$comments)->with('recommended_movies',$recommended_movies);
        }else{
            $movies = Movie::orderBy('created_at','DESC')->paginate(2);

            $genres = Genre::all();

            return view('browseMovies')->with('movies',$movies)->with('genres',$genres);
        }
    }

    //get movies by an actor
    public function moviesByActor($actor_id)
    {
        $actor = Actor::find($actor_id);

        if(!$actor){
            return back()->with(['fail','Oops, that actor is no longer in database']);
        }

        $movies = $actor->movies()->paginate(2);

        return view('moviesbyActor')->with('actor',$actor)->with('movies',$movies);
    }

    //get movies by genre
    public function moviesByGenre($genre_id)
    {
        $genre = Genre::find($genre_id);

        $movies = $genre->movies()->orderBy('created_at','DESC')->paginate(2);

        return view('moviesByGenre')->with('movies',$movies)->with('genre',$genre);
    }

    public function userSearchMovies(Request $request)
    {
        Input::flash();

        $order = explode(":",$request->order);
        $movies = Movie::where([
            ['name','like','%'.$request->movie_name.'%'],
            ['imdb_rating','>=',$request->rating],
        ])->orderBy($order[0],$order[1])->paginate(2);

        $movies->setPath('?movie_name='.$request->movie_name.'&genres='.$request->genre.'&rating='.$request->rating.'&order='.$order[0].'%3A'.$order[1]);

        //!! search genres !!//

        $genres = Genre::all();

        if($movies->isEmpty()){
            return back()->with(['fail'=>'There are no results']);
        }


        return view('browseMovies')->with('movies',$movies)->with('genres',$genres);
    }

    //add pictures for a movie
    public function addPictures(Request $request)
    {
        $movie_name = $this->removeForbiddenDirectoryCharacters($request->movie_name);
        Storage::makeDirectory('/images/movies/'.$movie_name.'-'.$request->movie_year);
        $images_path = public_path().'/images/movies/'.$movie_name.'-'.$request->movie_year.'/';

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
        $picture->images_directory_name = $movie_name.'-'.$request->movie_year;

        return $picture;
    }

    //edit movie pictures
    public function editPictures(Request $request,Movie $movie, Picture $picture,$movie_name)
    {
        $images_path = public_path().'/images/movies/'.$movie_name.'-'.$request->movie_year.'/';

        if($request->hasFile('poster_image')){
            $current_poster = $movie->pictures->poster_picture;
            Storage::delete('/images/movies/'.$movie_name.'-'.$request->movie_year.'/'.$current_poster);

            $poster_image = $request->file('poster_image');
            $poster_name = $poster_image->getClientOriginalName();
            Image::make($poster_image)->resize(280,410)->save($images_path . $poster_name);

            $picture->poster_picture = $poster_name;
        }

        if($request->hasFile('screenshot1_image')){
            $current_screeenshot1 = $movie->pictures->screenshot1;
            Storage::delete('/images/movies/'.$movie_name.'-'.$request->movie_year.'/'.$current_screeenshot1);

            $screenshot1_image = $request->file('screenshot1_image');
            $screenshot1_name = $screenshot1_image->getClientOriginalName();
            Image::make($screenshot1_image)->resize(1280,680)->save($images_path . $screenshot1_name);

            $picture->screenshot1 = $screenshot1_name;
        }

        if($request->hasFile('screenshot2_image')){
            $current_screeenshot2 = $movie->pictures->screenshot2;
            Storage::delete('/images/movies/'.$movie_name.'-'.$request->movie_year.'/'.$current_screeenshot2);

            $screenshot2_image = $request->file('screenshot2_image');
            $screenshot2_name = $screenshot2_image->getClientOriginalName();
            Image::make($screenshot2_image)->resize(1280,680)->save($images_path . $screenshot2_name);

            $picture->screenshot2 = $screenshot2_name;
        }
        $picture->images_directory_name = $movie_name.'-'.$request->movie_year;

        return $picture;
    }

    //remove forbidden directory characters from movie name and replace them with -
    public function removeForbiddenDirectoryCharacters($movieName)
    {
        $forbiddenCharacters = ["<",">",":",'"',"/","\\","|","?","*"];

        $movieName = str_replace($forbiddenCharacters,"-",$movieName);

        return $movieName;
    }
}

