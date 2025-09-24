@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Jouw tijdelijke playlists</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($playlists as $playlist)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">{{ $playlist['name'] }}</h5>
                </div>
                <div>
                    <a href="{{ route('guest.playlists.show', $playlist['id']) }}" class="btn btn-sm btn-primary">Bekijk</a>

                    <form method="POST" action="{{ route('guest.playlists.delete', $playlist['id']) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Weet je zeker dat je deze playlist wilt verwijderen?')">Verwijder</button>
                    </form>

                </div>
            </div>
        </div>
    @empty
        <p>Je hebt nog geen playlists aangemaakt.</p>
    @endforelse

    <hr class="my-4">

    <h4>Nieuwe playlist aanmaken</h4>
    <form method="POST" action="{{ route('guest.playlists.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Playlist naam</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Aanmaken</button>
    </form>
</div>
@endsection
