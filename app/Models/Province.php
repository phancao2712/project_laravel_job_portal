<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'gso_id',
        'country_id',
        'created_at',
        'updated_at'
    ];

    public function country(): BelongsTo {
        return $this->belongsTo(Country::class);
    }

    public function companies() : HasMany {
        return $this->hasMany(Company::class,'province','id');
    }
}
