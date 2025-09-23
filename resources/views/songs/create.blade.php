@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add new song</h2>

    <form method="POST" action="{{ route('songs.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Title</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="artist" class="form-label">Artist</label>
            <input type="text" name="artist" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add song</button>
    </form>
</div>
@endsection
