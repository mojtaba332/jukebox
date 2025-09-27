@extends('layouts.app')
@section('content')
<h1>Songs in Playlist: {{ $playlist->name }}</h1>

<ul>
    @forelse ($playlist->songs as $song)
        <li>
            <strong>{{ $song->name }}</strong> by {{ $song->artist }}
            ({{ $song->duration }} sec)
            <form action="{{ route('playlists.detachSong', [$playlist->id, $song->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-primary">Delete</button>
            </form>
        </li>
        
    @empty
        <li>No songs in this playlist yet.</li>
    @endforelse
</ul>

<a href="{{ route('playlists.addSongsForm', $playlist->id) }}" class="btn btn-sm btn-info">Add Songs</a>
@endsection