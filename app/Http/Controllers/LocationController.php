<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocationController extends Controller
{
    public function getProvinceByCountry(string $country_id) : Response
    {
        $provinces = Province::where('country_id', $country_id)->get();
        return response($provinces);
    }
}
