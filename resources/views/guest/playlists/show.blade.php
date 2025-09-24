@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>{{ $playlist['name'] }}</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h4 class="mt-4">Liedjes in deze playlist</h4>
    @forelse ($playlist['songs'] as $song)
        <div class="card mb-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $song['name'] }}</strong> – {{ $song['artist'] }}
                </div>
                <form method="POST" action="{{ route('guest.playlists.removeSong', [$playlist['id'], $song['id']]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Weet je zeker dat je dit liedje wilt verwijderen?')">Verwijder</button>
                </form>

            </div>
        </div>
    @empty
        <p>Geen liedjes toegevoegd.</p>
    @endforelse

    <h4 class="mt-5">Liedje toevoegen </h4>
    <form method="POST" action="{{ route('guest.playlists.addSong', $playlist['id']) }}">
        @csrf
        <div class="mb-3">
            <label for="song_id" class="form-label">Kies een liedje</label>
            <select name="song_id" class="form-select" required>
                <option value="">-- Selecteer een liedje --</option>
                @foreach ($songs as $song)
                    <option value="{{ $song->id }}">{{ $song->name }} – {{ $song->artist }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Toevoegen</button>
    </form>


    <div class="mt-4">
        <a href="{{ route('guest.playlists') }}" class="btn btn-secondary">Terug naar playlists</a>
    </div>
</div>
@endsection
