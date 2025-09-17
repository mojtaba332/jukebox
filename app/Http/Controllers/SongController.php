<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Song;

class SongController extends Controller
{
    public function index(Genre $genre)
    {
        $songs = $genre->songs;
        return view('songs.index', compact('genre', 'songs'));
    }

    public function show(Song $song)
    {
        return view('songs.show',compact('song'));
    }
    public function all()
    {
        $songs = Song::with('genre')->get(); // eager load genre
        return view('songs.all', compact('songs'));
    }
}
