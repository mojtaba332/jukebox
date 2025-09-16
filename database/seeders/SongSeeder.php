<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $songs = [
            ['name' => 'Bohemian Rhapsody', 'artist' => 'Queen', 'duration' => 354, 'genre_id' => 2],
            ['name' => 'Lose Yourself', 'artist' => 'Eminem', 'duration' => 326, 'genre_id' => 4],
            ['name' => 'Imagine', 'artist' => 'John Lennon', 'duration' => 183, 'genre_id' => 1],
            ['name' => 'Take Five', 'artist' => 'Dave Brubeck', 'duration' => 324, 'genre_id' => 3],
            ['name' => 'Für Elise', 'artist' => 'Beethoven', 'duration' => 210, 'genre_id' => 5],
        ];

        foreach ($songs as $song) {
            \App\Models\Song::create($song);
        }
    }

}
