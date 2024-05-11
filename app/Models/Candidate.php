<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Candidate extends Model
{
    use HasFactory, Sluggable;

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
        'profession_id',
        'country',
        'district',
        'province',
        'address',
        'phone_one',
        'phone_two',
        'email',
        'profile_complete',
        'visibility',
        'slug'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'fullname'
            ]
        ];
    }

    function experiences() : HasMany
    {
        return $this->hasMany(CandidateExperience::class, 'candidate_id', 'id')->orderBy('id', 'DESC');
    }

    function skills(): HasMany
    {
        return $this->hasMany(CandidateSkill::class, 'candidate_id', 'id');
    }

    function languages(): HasMany
    {
        return $this->hasMany(CandidateLanguage::class, 'candidate_id', 'id');
    }


    function educations() : HasMany
    {
        return $this->hasMany(CandidateEducation::class, 'candidate_id', 'id')->orderBy('id', 'DESC');
    }

    function candidateCountry() : BelongsTo
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    function candidateProvince() : BelongsTo
    {
        return $this->beLongsTo(Province::class, 'province', 'id');
    }

    function experience() : BelongsTo
    {
        return $this->belongsTo(Experience::class, 'experience_id', 'id');
    }

    function profession() : BelongsTo
    {
        return $this->belongsTo(Profession::class, 'profession_id', 'id');
    }
}
