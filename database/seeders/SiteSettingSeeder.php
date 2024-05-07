<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $site_settings = array(
            array(
                "id" => 1,
                "key" => "site_name",
                "value" => "JOBLIST",
                "created_at" => "2024-03-08 09:15:21",
                "updated_at" => "2024-03-08 09:43:07",
            ),
            array(
                "id" => 2,
                "key" => "site_email",
                "value" => "phancaoa1@gmail.com",
                "created_at" => "2024-03-08 09:15:21",
                "updated_at" => "2024-03-08 09:43:07",
            ),
            array(
                "id" => 3,
                "key" => "site_phone",
                "value" => "0866832034",
                "created_at" => "2024-03-08 09:15:21",
                "updated_at" => "2024-03-08 09:43:07",
            ),
            array(
                "id" => 4,
                "key" => "site_default_currency",
                "value" => "US",
                "created_at" => "2024-03-08 09:15:21",
                "updated_at" => "2024-03-08 09:42:34",
            ),
            array(
                "id" => 5,
                "key" => "site_currency_icon",
                "value" => "$",
                "created_at" => "2024-03-08 09:15:21",
                "updated_at" => "2024-04-20 19:40:39",
            ),
        );

        \DB::table('site_settings')->insert($site_settings);
    }
}
