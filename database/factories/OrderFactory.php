<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => '1',
            'car_id' => '1',
            'status' => 'pending',
            'driver' => 'car_only',
            'start_rent' => now(),
            'end_rent' => fake()->date(),
            'duration' => fake()->randomNumber(),
            'unit' => '5',
            'total_price' => '325000'
        ];
    }
}
