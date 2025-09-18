@extends('layouts.app')

@section('content')
    <h1>Edit Song: {{ $song->name }}</h1>

    <form method="POST" action="/songs/{{ $song->id }}">
        @csrf
        @method('PUT')

        <label>Name:</label>
        <input type="text" name="name" value="{{ $song->name }}" required><br>

        <label>Artist:</label>
        <input type="text" name="artist" value="{{ $song->artist }}" required><br>

        <label>Duration (sec):</label>
        <input type="number" name="duration" value="{{ $song->duration }}" required><br>

        <label>Genre:</label>
        <select name="genre_id" required>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ $song->genre_id == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Update Song</button>
    </form>
@endsection
