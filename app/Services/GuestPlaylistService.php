<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use App\Models\Song;
use Carbon\Carbon;

class GuestPlaylistService
{
    protected $sessionKey = 'guest_playlists';
    protected $timeoutSeconds;

    public function __construct()
    {
        // Playlists expire after 30 minutes
        $this->timeoutSeconds = 30 * 60;
    }

    public function create(string $name): array
    {
        $playlists = $this->getAllRaw();
        $id = $this->generateId($playlists);
        $now = Carbon::now()->timestamp; //huidige datum en tijd.

        $playlist = [
            'id' => $id,
            'name' => $name,
            'songs' => [],
            'created_at' => $now,
        ];

        $playlists[] = $playlist;
        $this->saveAllRaw($playlists);

        return $playlist;
    }

    public function addSong(int $playlistId, int $songId): void
    {
        $playlists = $this->getAllRaw();
        foreach ($playlists as &$p) {
            if ($p['id'] === $playlistId) {
                $ids = array_map(fn($s) => is_array($s) ? $s['id'] : $s, $p['songs']);
                if (!in_array($songId, $ids)) {
                    $p['songs'][] = $songId;
                }
                break;
            }
        }
        $this->saveAllRaw($playlists);
    }

    public function removeSong(int $playlistId, int $songId): void
    {
        $playlists = $this->getAllRaw();
        foreach ($playlists as &$p) {
            if ($p['id'] === $playlistId) {
                $p['songs'] = array_values(array_filter($p['songs'], fn($s) =>
                    (is_array($s) ? $s['id'] : $s) !== $songId
                ));
                break;
            }
        }
        $this->saveAllRaw($playlists);
    }

    public function delete(int $playlistId): void
    {
        $playlists = $this->getAllRaw();
        $playlists = array_values(array_filter($playlists, fn($p) => $p['id'] !== $playlistId));
        $this->saveAllRaw($playlists);
    }

    public function get(int $playlistId): ?array
    {
        foreach ($this->getAll() as $p) {
            if ($p['id'] === $playlistId) {
                return $p;
            }
        }
        return null;
    }

    public function list(): array
    {
        return $this->getAll();
    }

    public function getTotalDuration(int $playlistId): int
    {
        $playlist = $this->get($playlistId);
        if (!$playlist) return 0;

        $ids = array_map(fn($s) => is_array($s) ? $s['id'] : $s, $playlist['songs']);
        $songs = Song::whereIn('id', $ids)->get();

        $total = 0;
        foreach ($songs as $song) {
            $total += $this->parseDurationToSeconds($song->duration);
        }
        return $total;
    }

    /* ---- Internal helpers ---- */

    protected function getAll(): array
    {
        $raw = $this->getAllRaw();
        $now = Carbon::now()->timestamp;
        $pruned = [];

        foreach ($raw as $p) {
            if (($now - ($p['created_at'] ?? $now)) > $this->timeoutSeconds) {
                continue; // expired
            }

            $ids = array_map(fn($s) => is_array($s) ? $s['id'] : $s, $p['songs']);
            $songs = Song::whereIn('id', $ids)->get()
                ->map(fn($song) => [
                    'id' => $song->id,
                    'name' => $song->name,
                    'artist' => $song->artist,
                    'duration' => $song->duration,
                ])->toArray();

            $p['songs'] = $songs;
            $pruned[] = $p;
        }

        $this->saveAllRaw($pruned);
        return $pruned;
    }

    protected function getAllRaw(): array
    {
        return Session::get($this->sessionKey, []);
    }

    protected function saveAllRaw(array $playlists): void
    {
        Session::put($this->sessionKey, $playlists);
    }

    protected function generateId(array $playlists): int
    {
        $max = 0;
        foreach ($playlists as $p) {
            $id = isset($p['id']) ? (int)$p['id'] : 0;
            if ($id > $max) {
                $max = $id;
            }
        }
        return $max + 1;
    }


    protected function parseDurationToSeconds($duration): int
    {
        if (is_numeric($duration)) return (int)$duration;

        $parts = array_reverse(explode(':', $duration));
        $seconds = 0;
        if (isset($parts[0])) $seconds += (int)$parts[0];
        if (isset($parts[1])) $seconds += (int)$parts[1] * 60;
        if (isset($parts[2])) $seconds += (int)$parts[2] * 3600;
        return $seconds;
    }
}
