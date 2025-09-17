@extends('layouts.app')
@section('content')
<h1>Create Playlist</h1>

<form method="POST" action="/playlists">
    @csrf
    <input type="text" name="name" placeholder="Playlist name" required>
    <button type="submit">Create</button>
</form>
@endsection