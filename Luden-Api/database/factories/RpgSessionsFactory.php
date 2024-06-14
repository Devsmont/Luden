<?php

namespace Database\Factories;

use App\Models\Rpg;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RpgSessions>
 */
class RpgSessionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rpg_id' => Rpg::all()->random()->id,
            'name' => fake()->word(),
            'session_notes' => fake()->text(),
            'session_date' => fake()->dateTime()
        ];
    }
}
