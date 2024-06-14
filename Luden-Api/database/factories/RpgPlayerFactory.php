<?php

namespace Database\Factories;

use App\Models\Rpg;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RpgPlayer>
 */
class RpgPlayerFactory extends Factory
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
            'rpg_id' => Rpg::all()->random()->id
        ];
    }
}
