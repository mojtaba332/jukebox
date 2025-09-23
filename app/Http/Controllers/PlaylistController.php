<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;

class PlaylistController extends Controller
{
    public function create()
    {
        return view('playlists.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate(['name' => 'required']);
    //     Playlist::create(['name' => $request->name]);
    //     return redirect('/playlists');
    // }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $playlist = Playlist::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('playlists.index')->with('success', 'Playlist aangemaakt!');
    }

    public function addSongsForm($id)
    {
        $playlist = Playlist::findOrFail($id);
        $songs = Song::all();
        return view('playlists.add-songs', compact('playlist', 'songs'));
    }

    public function attachSongs(Request $request, $id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->songs()->sync($request->songs); // attach selected songs
        return redirect('/playlists/' . $id . '/songs');
    }

    public function showSongs($id)
    {
        $playlist = Playlist::with('songs')->findOrFail($id);
        return view('playlists.songs', compact('playlist'));
    }

    public function show(Playlist $playlist)
    {
        if ($playlist->user_id !== auth()->id()) {
            abort(403); // Forbidden
        }

        return view('playlists.show', compact('playlist'));
    }


    //aut
    public function index()
    {
        $playlists = Playlist::where('user_id', Auth::id())->get();
        return view('playlists.index', compact('playlists'));
    }

    public function edit(Playlist $playlist)
    {
        if ($playlist->user_id !== Auth::id()) {
            abort(403);
        }
        return view('playlists.edit', compact('playlist'));
    }

    public function update(Request $request, Playlist $playlist)
    {
        $request->validate(['name' => 'required']);
        $playlist->update(['name' => $request->name]);
        return redirect('/playlists/' . $playlist->id . '/songs');
    }

    public function destroy(Playlist $playlist)
    {
        $playlist->delete();
        return redirect('/playlists')->with('success', 'Playlist deleted.');
    }

}
