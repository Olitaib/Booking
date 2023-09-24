<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(2),
            'description' => fake()->paragraph(),
            'poster_url' => 'https://source.unsplash.com/random/900×700/?room',
            'floor_area' => rand(1, 10),
            'type' => rand(0, 5),
            'price' => rand(100, 500),
            'hotel_id' => Hotel::all()->random()->id,
        ];
    }
}
