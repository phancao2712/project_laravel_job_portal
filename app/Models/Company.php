<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    function companyCountry() : BelongsTo
    {
        return $this->BelongsTo(Country::class, 'country', 'id');
    }

    function companyProvince() : BelongsTo
    {
        return $this->BelongsTo(Province::class, 'province', 'id');
    }

    function companyDistrict() : BelongsTo
    {
        return $this->BelongsTo(District::class, 'district', 'id');
    }
}
