<?php

namespace App\Providers;

use App\Models\Characters;
use App\Models\Rpg;
use App\Models\RpgPlayer;
use App\Models\RpgSystem;
use App\Models\Skill;
use App\Models\User;
use App\Repositories\CharacterRepositoryEloquent;
use App\Repositories\RpgPlayerRepositoryEloquent;
use App\Repositories\RpgRepositoryEloquent;
use App\Repositories\RpgSystemRepositoryEloquent;
use App\Repositories\SkillRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Interfaces\Repositories\IUserRepository',
            'App\Repositories\UserRepositoryEloquent'
        );
        $this->app->bind('App\Interfaces\Repositories\IUserRepository', function () {
            return new UserRepositoryEloquent(new User());
        });

        $this->app->bind(
            'App\Interfaces\Repositories\ICharacterRepository',
            'App\Repositories\CharacterRepositoryEloquent'
        );

        $this->app->bind('App\Interfaces\Repositories\ICharacterRepository', function () {
            return new CharacterRepositoryEloquent(new Characters());
        });

        $this->app->bind(
            'App\Interfaces\Repositories\IRpgSystemRepository',
            'App\Repositories\RpgSystemRepositoryEloquent'
        );

        $this->app->bind('App\Interfaces\Repositories\IRpgSystemRepository', function () {
            return new RpgSystemRepositoryEloquent(new RpgSystem());
        });

        $this->app->bind(
            'App\Interfaces\Repositories\IRpgRepository',
            'App\Repositories\RpgRepositoryEloquent'
        );

        $this->app->bind('App\Interfaces\Repositories\IRpgRepository', function () {
            return new RpgRepositoryEloquent(new Rpg());
        });

        $this->app->bind(
            'App\Interfaces\Repositories\ISkillRepository',
            'App\Repositories\SkillRepositoryEloquent'
        );

        $this->app->bind('App\Interfaces\Repositories\ISkillRepository', function () {
            return new SkillRepositoryEloquent(new Skill());
        });

        $this->app->bind(
            'App\Interfaces\Repositories\IRpgPlayerRepository',
            'App\Repositories\RpgPlayerRepositoryEloquent'
        );

        $this->app->bind('App\Interfaces\Repositories\IRpgPlayerRepository', function () {
            return new RpgPlayerRepositoryEloquent(new RpgPlayer());
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
