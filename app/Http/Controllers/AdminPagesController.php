<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPagesController extends Controller
{
    //Return all genres order by name
    public function getGenres()
    {
        foreach(Auth::user()->roles as $role) {
            if ($role->name !== 'admin') {
                return redirect()->route('home');
            }
        }
        $genres = Genre::orderBy('name','ASC')->get();

        return view('genres')->with('genres',$genres);
    }

    //Add new genre
    public function postGenre(Request $request)
    {
        $this->validate($request, [
            'genre'=>'required|min:3|max:11|alpha'
        ]);

        $genre = Genre::where('name',$request['genre'])->first();
        if($genre){
            return redirect()->route('getGenres')->with(['fail'=>'Genre '.$genre->name.' is already in database']);
        }

        $genre = new Genre();
        $genre->name = $request['genre'];
        $genre->save();

        return redirect()->route('getGenres')->with(['success'=>'Genre '.$request["genre"].' successfully added']);
    }

    //Delete genre
    public function deleteGenre($genre_id)
    {
       $genre = Genre::find($genre_id);

        if(!$genre){
            return redirect()->route('getGenres')->with(['fail'=>'That genre s not in database']);
        }

        $genre->delete();
        return redirect()->route('getGenres')->with(['success'=>'Genre '.$genre->name.' successfully deleted']);
    }

    public function postEditGenre(Request $request, $genre_id)
    {
        $this->validate($request, [
            'genre'=>'required|min:3|max:11|alpha_dash'
        ]);

        $genre = Genre::find($genre_id);

        if(!$genre){
            return redirect()->route('getGenres')->with(['fail'=>'Genre '.$request['genre'].' is not in database']);
        }

        $genre->name = $request['genre'];
        $genre->save();

        return redirect()->route('getGenres')->with(['success'=>'Genre '.$request['genre'].' successfully edited']);
    }
}
