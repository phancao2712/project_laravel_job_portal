<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_menus = array(
            array(
                "id" => 2,
                "name" => "Navigation Menu",
                "created_at" => "2024-05-05 09:58:04",
                "updated_at" => "2024-05-05 10:11:48",
            ),
            array(
                "id" => 3,
                "name" => "Footer Menu One",
                "created_at" => "2024-05-05 11:13:02",
                "updated_at" => "2024-05-05 11:13:02",
            ),
            array(
                "id" => 4,
                "name" => "Footer Menu Two",
                "created_at" => "2024-05-05 11:13:17",
                "updated_at" => "2024-05-05 11:13:25",
            ),
            array(
                "id" => 5,
                "name" => "Footer Menu Three",
                "created_at" => "2024-05-05 11:13:50",
                "updated_at" => "2024-05-05 11:13:50",
            ),
            array(
                "id" => 6,
                "name" => "Footer Menu Four",
                "created_at" => "2024-05-05 11:14:02",
                "updated_at" => "2024-05-05 11:14:02",
            ),
        );

        \DB::table('admin_menus')->insert($admin_menus);
    }
}
