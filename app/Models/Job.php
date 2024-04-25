<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    function category() : BelongsTo
    {
        return $this->belongsTo(JobCategory::class,'job_category_id', 'id');
    }
    function company() : BelongsTo
    {
        return $this->belongsTo(Company::class,'company_id', 'id');
    }
    function provinces() : BelongsTo
    {
        return $this->belongsTo(Province::class,'province', 'id');
    }
    function countries() : BelongsTo
    {
        return $this->belongsTo(Country::class,'country', 'id');
    }
    function districts() : BelongsTo
    {
        return $this->belongsTo(District::class,'district', 'id');
    }
    function salaryType() : BelongsTo
    {
        return $this->belongsTo(SalaryType::class,'salary_type_id', 'id');
    }
    function jobType() : BelongsTo
    {
        return $this->belongsTo(JobType::class,'job_type_id', 'id');
    }
    function role() : BelongsTo
    {
        return $this->belongsTo(JobRole::class,'job_role_id', 'id');
    }
    function tags() : HasMany
    {
        return $this->hasMany(JobTag::class, 'job_id' , 'id');
    }
    function skills() : HasMany
    {
        return $this->hasMany(JobSkill::class, 'job_id' , 'id');
    }
    function benefits() : HasMany
    {
        return $this->hasMany(JobBenefits::class, 'job_id' , 'id');
    }
    function education() : BelongsTo
    {
        return $this->BelongsTo(Education::class,'education_id', 'id');
    }
    function jobExperience() : BelongsTo
    {
        return $this->belongsTo(Experience::class,'job_experience_id', 'id');
    }
    function appliedJobs() : HasMany {
        return $this->hasMany(AppliedJob::class,'job_id','id');
    }
}
