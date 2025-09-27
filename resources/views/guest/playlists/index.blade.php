@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Guest Playlists</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('guest.playlists.create') }}" class="btn btn-primary mb-3">Create Playlist</a>

    @if($playlists && count($playlists) > 0)
        <ul class="list-group">
            @foreach($playlists as $playlist)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('guest.playlists.show', $playlist['id']) }}">
                        {{ $playlist['name'] }}
                    </a>
                    <form action="{{ route('guest.playlists.delete', $playlist['id']) }}" method="POST" class="ms-3">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No guest playlists found.</p>
    @endif
</div>
@endsection
