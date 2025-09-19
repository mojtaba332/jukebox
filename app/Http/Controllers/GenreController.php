<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }
    public function show(Genre $genre)
    {
        $songs = $genre->songs()->get();
        return view('genres.songs', compact('genres', 'songs'));
    }
}
