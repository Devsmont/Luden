<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rpg extends Model
{
    use HasFactory;

    protected $fillable = [
        'rpg_system_id',
        'master_id',
        'name',
        'description',
        'image_url',
    ];

    public function master(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rpgSystem(): BelongsTo
    {
        return $this->belongsTo(RpgSystem::class);
    }

    public function rpgPlayers(): HasMany
    {
        return $this->hasMany(RpgPlayer::class);
    }

    public function rpgSessions(): HasMany
    {
        return $this->hasMany(RpgSessions::class);
    }

}
