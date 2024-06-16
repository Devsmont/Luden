<?php

namespace Database\Seeders;

use App\Models\Characters;
use App\Models\CharacterSkill;
use App\Models\Rpg;
use App\Models\RpgPlayer;
use App\Models\RpgSessions;
use App\Models\RpgSystem;
use App\Models\Skill;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\SkillFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        Characters::factory(5)->create();
        RpgSystem::factory(5)->create();
        Rpg::factory(5)->create();
        Skill::factory(5)->create();
        CharacterSkill::factory(5)->create();
        RpgPlayer::factory(5)->create();
        RpgSessions::factory(5)->create();
    }
}
