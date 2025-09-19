<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Song;


class SongSeeder extends Seeder
{
    public function run(): void
    {
        // Manually defined songs
        $songs = [
            ['name' => 'Bohemian Rhapsody', 'artist' => 'Queen', 'duration' => 354, 'genre_id' => 2],
            ['name' => 'Lose Yourself', 'artist' => 'Eminem', 'duration' => 326, 'genre_id' => 4],
            ['name' => 'Imagine', 'artist' => 'John Lennon', 'duration' => 183, 'genre_id' => 1],
            ['name' => 'Take Five', 'artist' => 'Dave Brubeck', 'duration' => 324, 'genre_id' => 3],
            ['name' => 'Für Elise', 'artist' => 'Beethoven', 'duration' => 210, 'genre_id' => 5],
        ];

        foreach ($songs as $song) {
            Song::create($song);
        }

        // Generate ?? random songs using factory
        Song::factory()->count(10)->create();
    }
}
