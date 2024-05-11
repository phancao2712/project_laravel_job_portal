<?php

namespace App\Traits;

use App\Models\Skill;
use Illuminate\Http\Request;

trait HasSkills
{
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    // Hàm getSkills trả về danh sách kỹ năng của ứng viên
    public function getSkills()
    {
        return $this->skills->pluck('name')->toArray();
    }
}
