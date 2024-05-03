<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'province_id',
        'country_id',
        'status'
    ];

    function country() : BelongsTo {
        return $this->belongsTo(Country::class,'country_id','id');
    }
    function province() : BelongsTo {
        return $this->belongsTo(Province::class,'province_id','id');
    }
}
