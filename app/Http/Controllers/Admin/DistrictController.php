<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\District;
use App\Models\Province;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;


class DistrictController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $query = District::query();

        $query->with('province');
        $query->with('country');
        $this->search($query, ['name']);
        $districts = $query->orderBy('id', 'DESC')->paginate(20);
        return view('admin.location.district.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();

        return view('admin.location.district.create', compact(
            'countries'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:districts,name'],
            'country_id' => ['required', 'integer'],
            'province_id' => ['required', 'integer']
        ]);

        $type = new District();
        $type->name = $request->name;
        $type->country_id = $request->country_id;
        $type->province_id = $request->province_id;
        $type->save();

        Notify::CreateNotify();
        return to_route('admin.district.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $district = District::findOrFail($id);
        $countries = Country::all();
        $provinces = Province::where('country_id', $district->country_id)->get();

        return view('admin.location.district.edit', compact(
            'district',
            'countries',
            'provinces'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:districts,name'],
            'country_id' => ['required', 'integer'],
            'province_id' => ['required', 'integer'],
        ]);

        $type = District::findOrFail($id);
        $type->name = $request->name;
        $type->country_id = $request->country_id;
        $type->province_id = $request->province_id;
        $type->save();

        Notify::UpdateNotify();
        return to_route('admin.district.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            District::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}