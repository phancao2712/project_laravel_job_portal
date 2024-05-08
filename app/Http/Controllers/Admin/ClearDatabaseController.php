<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Artisan;
use File;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClearDatabaseController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission: database clear']);
    }
    public function index(): View
    {
        return view('admin.clear-db.index');
    }

    public function clearDatabase()
    {
        try {
            Artisan::call('migrate:fresh');

            $seeders = [
                'SiteSettingSeeder',
                'AdminMenuSeeder',
                'AdminSeeder',
                'PaymentSettingSeeder'
            ];

            foreach ($seeders as $seeder) {
                Artisan::class('db:seed', ['--class' => $seeder]);
            }

            $this->deleteFile();

            return response(['message' => 'Delete database successfully']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    function deleteFile()
    {
        $path = public_path('upload');

        $all_file = File::allFiles($path);
        foreach ($all_file as $file) {
            $filename = $file->getFilename();
            File::delete($filename);
        }
    }
}
