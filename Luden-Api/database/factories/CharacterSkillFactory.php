<?php

namespace Database\Factories;

use App\Models\Characters;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CharacterSkill>
 */
class CharacterSkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'characters_id' => Characters::all()->random()->id,
            'skill_id' => Skill::all()->random()->id,
            'value' => fake()->numberBetween(1, 100)
        ];
    }
}
