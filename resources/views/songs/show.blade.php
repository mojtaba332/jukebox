<h1>{{ $song->name }}</h1>

<p><strong>Artist:</strong> {{ $song->artist }}</p>
<p><strong>Duration:</strong> {{ $song->duration }} seconds</p>
<p><strong>Genre:</strong> {{ $song->genre->name }}</p>

<a href="/genres/{{ $song->genre_id }}/songs">← Back to genre</a>
