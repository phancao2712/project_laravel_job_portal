<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
