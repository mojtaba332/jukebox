@extends('layouts.app')

@section('content')
    <h1>Edit Playlist: {{ $playlist->name }}</h1>

    <form method="POST" action="/playlists/{{ $playlist->id }}">
        @csrf
        @method('PUT')

        <label>Playlist Name:</label>
        <input type="text" name="name" value="{{ $playlist->name }}" required><br><br>

        <button type="submit">Update Playlist</button>
    </form>
@endsection
