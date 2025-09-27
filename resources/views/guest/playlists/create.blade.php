@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Guest Playlist</h1>

    <form action="{{ route('guest.playlists.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Playlist Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button class="btn btn-primary">Create</button>
        <a href="{{ route('guest.playlists.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
