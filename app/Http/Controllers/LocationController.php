<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocationController extends Controller
{
    public function getProvinceByCountry(string $country_id) : Response
    {
        $provinces = Province::select(['id', 'name', 'country_id'])->where('country_id', $country_id)->get();
        return response($provinces);
    }   

    public function getDistrict(string $province_id) : Response
    {
        $district = District::select(['id', 'name', 'country_id', 'province_id'])->where('province_id', $province_id)->get();
        return response($district);
    }
}
