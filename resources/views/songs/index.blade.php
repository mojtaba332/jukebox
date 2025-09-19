@extends('layouts.app')
@section('content')
<h1>Songs in {{ $genre->name }}</h1>

<ul>
    @foreach ($songs as $song)
        <li>
            <strong>{{ $song->name }}</strong> by {{ $song->artist }} ({{ $song->duration }} sec)
        </li>
    @endforeach
</ul>
@endsection