<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Characters>
 */
class CharactersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'name' => fake()->name(),
            'visibility'=> fake()->boolean,
            'description' => fake()->text(),
            'birth_date' => fake()->dateTime(),
            'image_url' => fake()->imageUrl(),
            'status' => fake()->randomElement(['normal','morto','inconsciente','louco'])
        ];
    }
}
