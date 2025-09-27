@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Songs to {{ $playlist['name'] }}</h1>

    <form action="{{ route('guest.playlists.addSong', $playlist['id']) }}" method="POST">
        @csrf

        <div class="mb-3" style="max-height: 400px; overflow-y: auto;">
            @foreach($songs as $song)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" 
                           name="song_ids[]" 
                           value="{{ $song->id }}" 
                           id="song-{{ $song->id }}"
                    <label class="form-check-label" for="song-{{ $song->id }}">
                        {{ $song->name }} — {{ $song->artist }} ({{ $song->duration }})
                        
                    </label>
                </div>
            @endforeach
        </div>

        <button class="btn btn-primary">Add Selected Songs</button>
        <a href="{{ route('guest.playlists.show', $playlist['id']) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
