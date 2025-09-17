@extends('layouts.app')

@section('content')
<h1>All Playlists</h1>

<ul>
    @foreach ($playlists as $playlist)
        <li>
            <a href="/playlists/{{ $playlist->id }}/songs">
                {{ $playlist->name }}
            </a>
        </li>
    @endforeach
</ul>

<a href="/playlists/create">Create New Playlist</a>
@endsection