<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TripRequest>
 */
class TripRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'destination' => 'São Paulo, SP',
            'departure_date' => now(),
            'return_date' => now()->add(5, 'days'),
            'status' => 'pending',
            'user_id' => 1,
        ];
    }
}
