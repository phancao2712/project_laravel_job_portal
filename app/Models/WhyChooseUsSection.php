<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseUsSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon_1',
        'title_1',
        'subtitle_1',
        'icon_2',
        'title_2',
        'subtitle_2',
        'icon_3',
        'title_3',
        'subtitle_3',
    ];
}
