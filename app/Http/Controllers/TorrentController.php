<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class TorrentController extends Controller
{
    public function downloadTorrent($movie_id)
    {
        $movie = Movie::find($movie_id);
        $movie->downloaded += 1;
        $movie->save();
        return response()->download(public_path().'/torrents/movie.torrent');
    }
}
