<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'company',
        'department',
        'designation',
        'start',
        'end',
        'responsibilites',
        'current_working'
    ];

    protected $dates = [
        'start',
        'end'
    ];
    
}
