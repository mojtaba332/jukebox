@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="jumbotron text-center">
        <h1 class="display-4">Welcome to the Jukebox!</h1>
        <p class="lead">Discover songs, genres and create your own playlists.</p>
        <hr class="my-4">

        @auth
            <p>Je bent ingelogd als <strong>{{ auth()->user()->name }}</strong>.</p>
        @else
            <p>Create an account or login to manage your own playlists.</p>
        @endauth

        <div class="mt-4 d-flex justify-content-center flex-wrap gap-3">
            <a class="btn btn-primary btn-lg" href="/songs">Songs</a>
            <a class="btn btn-info btn-lg" href="/genres">Genres</a>

            @auth
                <a class="btn btn-success btn-lg" href="{{ route('playlists.index') }}">Mijn Playlists</a>
                <!-- <a class="btn btn-warning btn-lg" href="/playlists/create">Make New Account</a> -->
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-lg">LogOut</button>
                </form>
            @else
                <a href="/guest/playlists" class="btn btn-outline-primary btn-lg">Playlists</a>
                <a class="btn btn-outline-primary btn-lg" href="/register">CreateAccount</a>
                <a class="btn btn-outline-secondary btn-lg" href="/login">Login</a>
            @endauth
        </div>
        <br>
        <img src="{{ asset('storage/juke.png') }}" alt="Jukebox Banner" class="img-fluid mb-4">
    </div>
</div>
@endsection
