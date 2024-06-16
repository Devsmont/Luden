<?php

namespace Database\Factories;

use App\Models\RpgSystem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rpg>
 */
class RpgFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rpg_system_id' => RpgSystem::all()->random()->id,
            'master_id' => User::all()->random()->id,
            'name' => fake()->unique()->word(),
            'description' => fake()->paragraph(),
            'image_url' => fake()->imageUrl()
        ];

    }
}
