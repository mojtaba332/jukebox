<!DOCTYPE html>
<html>
<head>
    <title>Jukebox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">🎵 Jukebox</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="/genres">Genres</a></li>
                    <li class="nav-item"><a class="nav-link" href="/playlists">Playlists</a></li>
                    <li class="nav-item"><a class="nav-link" href="/playlists/create">Create Playlist</a></li>
                    <li class="nav-item"><a class="nav-link" href="/songs">All Songs</a></li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
