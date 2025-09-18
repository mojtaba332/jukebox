<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Song;

class SongController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $genreId = $request->input('genre_id');

        $songs = Song::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('artist', 'like', "%{$search}%");
            })
            ->when($genreId, function ($query, $genreId) {
                $query->where('genre_id', $genreId);
            })
            ->get();

        $genres = Genre::all(); // ✅ This line is essential

        return view('songs.all', compact('songs', 'search', 'genreId', 'genres'));
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
    public function edit(Song $song)
    {
        $genres = \App\Models\Genre::all(); // for dropdown
        return view('songs.edit', compact('song', 'genres'));
    }

    public function update(Request $request, Song $song)
    {
        $request->validate([
            'name' => 'required',
            'artist' => 'required',
            'duration' => 'required|numeric',
            'genre_id' => 'required|exists:genres,id',
        ]);

        $song->update($request->only(['name', 'artist', 'duration', 'genre_id']));
        return redirect('/songs/' . $song->id);
    }

    public function destroy(Song $song)
    {
        $song->delete();
        return redirect('/songs')->with('success', 'Song deleted.');
    }

}
