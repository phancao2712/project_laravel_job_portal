<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            'English',
            'VietNam',
            'Hindi',
            'Arabic',
            'Bangla'
        ];

        foreach ($languages as $language) {
            $model = new Language();
            $model->name = $language;
            $model->save();
        }
    }
}
