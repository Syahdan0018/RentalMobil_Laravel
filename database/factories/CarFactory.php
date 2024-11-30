<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'regional_id' => '1',
            'car_name' => fake()->firstNameFemale,
            'address' => fake()->address,
            'number_of_car' => fake()->numberBetween(),
            'price' => fake()->randomNumber(),
            'picture' => fake()->image(storage_path('app/public'), 150 , 150 , null, false)
        ];
    }
}
