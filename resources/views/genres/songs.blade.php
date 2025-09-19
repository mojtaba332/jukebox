@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Liedjes in genre: {{ $genre->name }}</h2>

    @if ($songs->isEmpty())
        <p>Geen liedjes gevonden in dit genre.</p>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($songs as $song)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $song->name }}</h5>
                            <p class="card-text">Artiest: {{ $song->artist }}</p>
                            <a href="/songs/{{ $song->id }}" class="btn btn-outline-primary">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
