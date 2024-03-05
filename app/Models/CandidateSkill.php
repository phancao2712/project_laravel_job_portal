<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CandidateSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'skill_id'
    ];

    public function skill() : BelongsTo {
        return $this->belongsTo(Skill::class, 'skill_id', 'id');
    }
}
