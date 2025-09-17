@extends('layouts.app')

@section('content')
<h1>Add Songs to Playlist</h1>

<form method="POST" action="/playlists/{{ $playlist->id }}/songs">
    @csrf

    <label>Select songs:</label><br>
    @foreach ($songs as $song)
        <input type="checkbox" name="songs[]" value="{{ $song->id }}">
        {{ $song->name }} by {{ $song->artist }}<br>
    @endforeach

    <button type="submit">Add to Playlist</button>
</form>
@endsection