<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id' => $id = Room::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'started_at' => $startDate = fake()->date('Y-m-d', '+100 days'),
            'days' => $days = rand(1, 20),
            'finished_at'=> date('Y-m-d', strtotime("$startDate + $days days")),
            'price' => $days*Room::find($id)->price,
        ];
    }
}
