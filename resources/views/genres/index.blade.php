@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Genres</h2>

    <div class="list-group">
        @foreach ($genres as $genre)
            <a href="{{ url('/songs?genre_id=' . $genre->id) }}" class="list-group-item list-group-item-action">
                {{ $genre->name }}
            </a>
        @endforeach
    </div>
</div>
@endsection
