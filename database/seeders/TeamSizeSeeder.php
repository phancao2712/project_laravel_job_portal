<?php

namespace Database\Seeders;

use App\Models\TeamSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TeamSize::insert([
            [
                'name' => 'Only me',
                'slug' => 'only-me',
            ],
            [
                'name' => '1-5 Members',
                'slug' => '1-5-member',
            ],
            [
                'name' => '5-10 Members',
                'slug' => '5-10-member',
            ],
            [
                'name' => '10-20 Members',
                'slug' => '10-20-member',
            ],
            [
                'name' => '20-50 Members',
                'slug' => '20-50-member',
            ],
            [
                'name' => '50-100 Members',
                'slug' => '50-100-member',
            ],
            [
                'name' => '100-200 Members',
                'slug' => '100-200-member',
            ],
            [
                'name' => '200-300 Members',
                'slug' => '200-300-member',
            ],
            [
                'name' => '400-200 Members',
                'slug' => '400-200-member',
            ],
            [
                'name' => '500+ Members',
                'slug' => '500-member',
            ],
        ]);
    }
}
