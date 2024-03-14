<?php

namespace Database\Seeders;

use App\Models\JobExperience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $job_experiences = [
            'Fresher',
            '1 Year',
            '2 Year',
            '3+ Year',
            '5+ Year',
            '8+ Year',
            '10+ Year',
            '15+ Year'
        ];

        foreach ($job_experiences as $job_exp) {
            $model = new JobExperience();
            $model->name = $job_exp;
            $model->save();
        }
    }
}
