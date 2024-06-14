<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RpgSystem>
 */
class RpgSystemFactory extends Factory
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
            'skill_dice' => fake()->randomElement(['4','6','8','10','12','20','100']),
            'description' => fake()->text(),
            'image_url' => fake()->imageUrl()
        ];
    }
}
