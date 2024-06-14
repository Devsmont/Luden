<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RpgSessions extends Model
{
    use HasFactory;

    protected $fillable = [
        'rpg_id',
        'name',
        'session_notes',
        'session_date',
    ];

    public function rpg(): BelongsTo
    {
        return $this->belongsTo(Rpg::class);
    }
}
