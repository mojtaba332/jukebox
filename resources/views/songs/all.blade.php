@extends('layouts.app')

@section('content')
    <h1>All Songs</h1>

    <ul>
        @forelse ($songs as $song)
            <li>
                <strong>{{ $song->name }}</strong> by {{ $song->artist }}
                ({{ $song->duration }} sec) —
                Genre: {{ $song->genre->name ?? 'Unknown' }}
            </li>
        @empty
            <li>No songs found.</li>
        @endforelse
    </ul>
@endsection
