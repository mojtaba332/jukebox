@extends('layouts.app')
@section('content')
<h1>{{ $song->name }}</h1>

<p><strong>Artist:</strong> {{ $song->artist }}</p>
<p><strong>Duration:</strong> {{ $song->duration }} seconds</p>
<p><strong>Genre:</strong> {{ $song->genre->name }}</p>
<a href="/songs/{{ $song->id }}/edit">✏️ Edit</a>

<form method="POST" action="/songs/{{ $song->id }}" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Delete this song?')">🗑 Delete</button>
</form>


<a href="/genres/{{ $song->genre_id }}/songs">← Back to songs</a>
@endsection