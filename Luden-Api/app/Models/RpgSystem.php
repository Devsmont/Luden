<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class RpgSystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'skill_dice',
        'description',
        'image_url'
    ];

    public function skill(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function rpg(): HasMany
    {
        return $this->hasMany(Rpg::class);
    }
}
