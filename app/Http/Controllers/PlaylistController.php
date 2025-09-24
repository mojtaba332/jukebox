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

    public function guestStore(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $playlist = [
            'id' => uniqid(), // unique ID for this playlist
            'name' => $request->name,
            'songs' => [], // empty song list for now
        ];

        // Push the new playlist into the session
        session()->push('guest_playlists', $playlist);

        return redirect()->route('guest.playlists')->with('success', 'Playlist aangemaakt!');
    }
    public function guestIndex()
    {
        $playlists = session('guest_playlists', []);
        return view('guest.playlists.index', compact('playlists'));
    }
    public function guestShow($id)
    {
        $playlists = session('guest_playlists', []);
        $playlist = collect($playlists)->firstWhere('id', $id);

        if (!$playlist) {
            abort(404);
        }

        $songs = Song::all(); // fetch all songs from the database

        return view('guest.playlists.show', compact('playlist', 'songs'));
    }
    public function guestAddSong(Request $request, $id)
    {
        $request->validate(['song_id' => 'required|exists:songs,id']);

        $song = Song::find($request->song_id);

        $playlists = session('guest_playlists', []);
        $updated = [];

        foreach ($playlists as $playlist) {
            if ($playlist['id'] === $id) {
                $playlist['songs'][] = [
                    'id' => $song->id,
                    'name' => $song->name,
                    'artist' => $song->artist,
                ];
            }
            $updated[] = $playlist;
        }

        session(['guest_playlists' => $updated]);

        return redirect()->route('guest.playlists.show', $id)->with('success', 'Liedje toegevoegd aan playlist.');
    }

    public function guestRemoveSong($playlistId, $songId)
    {
        $playlists = session('guest_playlists', []);
        $updated = [];

        foreach ($playlists as $playlist) {
            if ($playlist['id'] === $playlistId) {
                $playlist['songs'] = array_filter($playlist['songs'], function ($song) use ($songId) {
                    return $song['id'] != $songId;
                });
            }
            $updated[] = $playlist;
        }

        session(['guest_playlists' => $updated]);

        return redirect()->route('guest.playlists.show', $playlistId)->with('success', 'Liedje verwijderd uit de playlist.');
    }

    public function guestDelete($id)
    {
        $playlists = session('guest_playlists', []);
        $updated = array_filter($playlists, fn($playlist) => $playlist['id'] !== $id);

        session(['guest_playlists' => $updated]);

        return redirect()->route('guest.playlists')->with('success', 'Playlist verwijderd.');
    }




}
