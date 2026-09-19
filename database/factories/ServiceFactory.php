<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'status' => fake()->randomElement(['online', 'offline', 'maintenance']),
        ];
    }
}
