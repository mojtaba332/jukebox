@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $playlist['name'] }}</h1>

    <p><strong>Total Duration:</strong> {{ gmdate('H:i:s', $totalDuration) }}</p>

    @if($playlist['songs'] && count($playlist['songs']) > 0)
        <ul class="list-group mb-3">
            @foreach($playlist['songs'] as $song)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $song['name'] }} — {{ $song['artist'] }} ({{ $song['duration'] }})
                    <form action="{{ route('guest.playlists.removeSong', [$playlist['id'], $song['id']]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Remove</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No songs in this playlist.</p>
    @endif


<a href="{{ route('guest.playlists.addSongsForm', $playlist['id']) }}" class="btn btn-success ">
    Add Songs
</a>

    <a href="{{ route('guest.playlists.index') }}" class="btn btn-secondary">Back to Playlists</a>
</div>
@endsection
