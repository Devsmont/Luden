<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CharacterSkill extends Model
{
    use HasFactory;
    protected $fillable = [
        'characters_id',
        'skill_id',
        'value'
    ];
    public function character() : BelongsTo
    {
       return $this->belongsTo(Characters::class);
    }

    public function skill() : BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
