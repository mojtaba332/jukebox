<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;
use App\Services\GuestPlaylistService;


class PlaylistController extends Controller
{
    public function create()
    {
        return view('playlists.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $playlist = Playlist::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('playlists.index')->with('success', 'Playlist aangemaakt!');
    }

    public function addSongsForm(Playlist $playlist)
    {
        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        $songs = Song::all();

        return view('playlists.add-songs', compact('playlist', 'songs'));
    }

    
    public function attachSong(Request $request, Playlist $playlist)
    {
        $request->validate([
            'songs' => 'required|array',
            'songs.*' => 'exists:songs,id',
        ]);

        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        $playlist->songs()->syncWithoutDetaching($request->songs);

        return redirect()->route('playlists.edit', $playlist)->with('success', 'Liedjes toegevoegd aan je playlist.');
    }
    public function detachSong(Playlist $playlist, Song $song)
    {
        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        $playlist->songs()->detach($song->id);

        return back()->with('success', 'Liedje verwijderd uit de playlist.');
    }


    public function showSongs(Playlist $playlist)
    {
        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

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
        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        $songs = Song::all();

        return view('playlists.edit', compact('playlist', 'songs'));
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

    protected $guestPlaylist;

    public function __construct(GuestPlaylistService $guestPlaylist)
    {
        $this->guestPlaylist = $guestPlaylist;
    }

    // Create a new guest playlist
    public function guestStore(Request $request)
    {
        $playlist = $this->guestPlaylist->create($request->input('name'));
        return redirect()->route('guest.playlists.index');
    }

    // List guest playlists
    public function guestIndex()
    {
        $playlists = $this->guestPlaylist->list();
        return view('guest.playlists.index', compact('playlists'));
    }

    public function guestShow($id)
    {
        $playlist = $this->guestPlaylist->get((int)$id);
        if (!$playlist) {
            return redirect()->route('guest.playlists.index')
                ->with('error', 'Playlist not found or expired.');
        }

        $totalDuration = $this->guestPlaylist->getTotalDuration((int)$id);
        return view('guest.playlists.show', compact('playlist', 'totalDuration'));
    }

    // Add a song
    public function guestAddSong(Request $request, $id)
    {
    $songIds = $request->input('song_ids', []); // array of selected checkboxes
    foreach ($songIds as $songId) {
        $this->guestPlaylist->addSong((int)$id, (int)$songId);
    }

    return redirect()->route('guest.playlists.show', $id);
    }

    // Remove a song
    public function guestRemoveSong($id, $songId)
    {
        $this->guestPlaylist->removeSong((int)$id, (int)$songId);
        return redirect()->route('guest.playlists.show', $id);
    }
    
    // Delete a playlist
    public function guestDelete($id)
    {
        $this->guestPlaylist->delete((int)$id);
        return redirect()->route('guest.playlists.index');
    }
    public function guestAddSongsForm($id)
{
    $playlist = $this->guestPlaylist->get((int)$id);
    if (!$playlist) {
        return redirect()->route('guest.playlists.index')
            ->with('error', 'Playlist not found or expired.');
    }

    $songs = \App\Models\Song::all();
    return view('guest.playlists.add_songs', compact('playlist', 'songs'));
}




}
