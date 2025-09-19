<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Genre;

class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'artist' => $this->faker->name(),
            'duration' => $this->faker->numberBetween(120, 300),
            'genre_id' => Genre::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
