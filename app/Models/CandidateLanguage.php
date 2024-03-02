<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CandidateLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'language_id'
    ];
}
