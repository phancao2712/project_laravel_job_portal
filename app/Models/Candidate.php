<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'experience_id',
        'title',
        'fullname',
        'image',
        'website',
        'cv',
        'birth_date',
        'gender',
        'bio',
        'marital_status',
        'status',
        'profession_id'
    ];

    function skills() : HasMany
    {
        return $this->hasMany(CandidateSkill::class, 'candidate_id', 'id');
    }

    function languages() : HasMany
    {
        return $this->hasMany(CandidateLanguage::class, 'candidate_id', 'id');
    }
}
