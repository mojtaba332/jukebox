@extends('layouts.app')

@section('content')
<h1>All Playlists</h1>
<ul>
    @foreach ($playlists as $playlist)
        <li>
            <a href="{{ route('playlists.showSongs', $playlist->id) }}">
    {{ $playlist->name }}
</a>

            @auth
    @if ($playlist->user_id === auth()->id())
        <a href="{{ route('playlists.edit', $playlist) }}">Edit</a>
        <form method="POST" action="{{ route('playlists.destroy', $playlist) }}">
            @csrf @method('DELETE')
            <button>Delete</button>
        </form>
    @endif
@endauth


        </li>
    @endforeach
</ul>


<a href="/playlists/create">Create New Playlist</a>
@endsection