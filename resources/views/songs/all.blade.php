@extends('layouts.app')

@section('content')

<form method="GET" action="/songs">
    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by name or artist">

    <select name="genre_id">
        <option value="">All Genres</option>
        @foreach ($genres as $genre)
            <option value="{{ $genre->id }}" {{ $genreId == $genre->id ? 'selected' : '' }}>
                {{ $genre->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Filter</button>
</form>





<h1>Songs</h1>
@if ($songs->isEmpty())
    <p>No songs found.</p>
@else
    <ul>
        @foreach ($songs as $song)
            <li>
                <a href="/songs/{{ $song->id }}">{{ $song->name }}</a> by {{ $song->artist }}
            </li>
        @endforeach
    </ul>
@endif


    

    <!-- <ul>
        @forelse ($songs as $song)
            <li>
                <strong>{{ $song->name }}</strong> by {{ $song->artist }}
                ({{ $song->duration }} sec) —
                Genre: {{ $song->genre->name ?? 'Unknown' }}
            </li>
        @empty
            <li>No songs found.</li>
        @endforelse
    </ul> -->
@endsection
