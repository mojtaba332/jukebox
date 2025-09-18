@extends('layouts.app')

@section('content')
<h1>All Playlists</h1>

<ul>
    @foreach ($playlists as $playlist)
        <li>
            <a href="/playlists/{{ $playlist->id }}/songs">
                {{ $playlist->name }}

            </a>
            <a href="/playlists/{{ $playlist->id }}/edit">✏️ Edit</a>

<form method="POST" action="/playlists/{{ $playlist->id }}" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Delete this playlist?')">🗑 Delete</button>
</form>

        </li>
    @endforeach
</ul>




<a href="/playlists/create">Create New Playlist</a>
@endsection