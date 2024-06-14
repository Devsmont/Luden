<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Characters extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'visibility',
        'description',
        'birth_date',
        'image_url',
        'status'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skill(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'character_skills')->withPivot(['value']);
    }
}
