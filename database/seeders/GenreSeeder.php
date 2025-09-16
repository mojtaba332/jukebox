<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $genres = ['Pop', 'Rock', 'Jazz', 'Hip-Hop', 'Classical'];

        foreach ($genres as $genre) {
            \App\Models\Genre::create(['name' => $genre]);
        }
    }

}
