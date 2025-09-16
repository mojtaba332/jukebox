<h1>Genres</h1>

<ul>
    @foreach ($genres as $genre)
        <li>{{ $genre->name }}</li>
    @endforeach
</ul>
