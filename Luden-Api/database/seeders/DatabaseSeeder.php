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
        User::factory(15)->create();
        Characters::factory(15)->create();
        RpgSystem::factory(15)->create();
        Rpg::factory(15)->create();
        Skill::factory(15)->create();
        CharacterSkill::factory(15)->create();
        RpgPlayer::factory(15)->create();
        RpgSessions::factory(15)->create();
    }
}
