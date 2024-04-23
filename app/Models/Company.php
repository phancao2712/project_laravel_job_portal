<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'banner',
        'bio',
        'vision',
        'slug',
        'industry_type_id',
        'organization_type_id',
        'team_size_id',
        'establishment_date',
        'website',
        'email',
        'phone',
        'country',
        'province',
        'district',
        'address',
        'map_link',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    function companyCountry(): BelongsTo
    {
        return $this->BelongsTo(Country::class, 'country', 'id');
    }
    function companyProvince(): BelongsTo
    {
        return $this->BelongsTo(Province::class, 'province', 'id');
    }
    function companyIndustry(): BelongsTo
    {
        return $this->BelongsTo(Industry_type::class, 'industry_type_id', 'id');
    }
    function companyOrganization(): BelongsTo
    {
        return $this->BelongsTo(Organization_type::class, 'organization_type_id', 'id');
    }
    function companyTeamSize(): BelongsTo
    {
        return $this->BelongsTo(TeamSize::class, 'team_size_id', 'id');
    }
    function userPlan(): HasOne
    {
        return $this->HasOne(UserPlan::class, 'company_id', 'id');
    }
    function jobs() : HasMany {
        return $this->hasMany(Job::class,'company_id','id');
    }
}
