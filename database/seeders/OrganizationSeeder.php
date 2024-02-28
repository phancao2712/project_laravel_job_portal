<?php

namespace Database\Seeders;

use App\Models\Organization_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organization = [
            'Government',
            'Semi Government',
            'Public',
            'Private',
            'NGO',
            'International Agencies',
        ];

        foreach ($organization as $type) {
            $organizationType = new Organization_type();
            $organizationType->name = $type;
            $organizationType->save();
        }
    }
}
