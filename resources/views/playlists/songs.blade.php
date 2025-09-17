@extends('layouts.app')
@section('content')
<h1>Songs in Playlist: {{ $playlist->name }}</h1>

<ul>
    @forelse ($playlist->songs as $song)
        <li>
            <strong>{{ $song->name }}</strong> by {{ $song->artist }}
            ({{ $song->duration }} sec)
        </li>
    @empty
        <li>No songs in this playlist yet.</li>
    @endforelse
</ul>

<a href="/playlists/{{ $playlist->id }}/add-songs">Add Songs</a>
@endsection