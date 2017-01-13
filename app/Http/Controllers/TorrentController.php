<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TorrentController extends Controller
{
    public function downloadTorrent()
    {
        return response()->download(public_path().'/torrents/movie.torrent');
    }
}
