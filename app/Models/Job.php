<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    use HasFactory, Sluggable;

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

    function role() : BelongsTo
    {
        return $this->belongsTo(JobRole::class,'job_role_id', 'id');
    }
}
