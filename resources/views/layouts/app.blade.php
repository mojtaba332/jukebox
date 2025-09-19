<!DOCTYPE html>
<html>
<head>
    <title>Jukebox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">🎵 Jukebox</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">

                    <li class="nav-item"><a class="nav-link" href="/songs">Songs</a></li>
                    <li class="nav-item"><a class="nav-link" href="/genres">Genres</a></li>

                @auth
                    <a href="/playlists">Mijn Playlists</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Uitloggen</button>
                    </form>
                @else
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">CreateAccount</a></li>
                @endauth
                </ul>
        
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
