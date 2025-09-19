@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form method="GET" action="/songs" class="mb-4 d-flex flex-wrap gap-3 align-items-center">
        <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Zoek op naam of artiest" style="max-width: 300px;">

        <select name="genre_id" class="form-select" style="max-width: 200px;">
            <option value="">Alle genres</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ $genreId == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    @auth
        <div class="mb-3">
            <p>Welkom terug, <strong>{{ auth()->user()->name }}</strong>!</p>
            <a href="/playlists/create" class="btn btn-success">Nieuwe playlist maken</a>
        </div>
    @endauth

    @guest
        <div class="mb-3">
            <p>Je bent niet ingelogd. <a href="/login">Log in</a> om playlists te beheren.</p>
        </div>
    @endguest

    <h2 class="mb-4">Liedjes</h2>

    @if ($songs->isEmpty())
        <p>Geen liedjes gevonden.</p>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($songs as $song)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $song->name }}</h5>
                            <!-- <p class="card-text">Artiest: {{ $song->artist }}</p>
                            <p class="card-text">Genre: {{ $song->genre->name ?? 'Onbekend' }}</p> -->
                            <a href="/songs/{{ $song->id }}" class="btn btn-outline-primary">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
