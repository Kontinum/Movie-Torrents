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
}
