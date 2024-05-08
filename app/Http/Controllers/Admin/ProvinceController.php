<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Province;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProvinceController extends Controller
{
    use Searchable;
    function __construct(){
        $this->middleware(['permission: job location']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Province::query();

        $query->with('country');
        $this->search($query, ['name']);

        $provinces = $query->orderBy('id', 'DESC')->paginate(20);

        return view('admin.location.province.index', compact(
            'provinces'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $countries = Country::all();

        return view('admin.location.province.create', compact(
            'countries'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:provinces,name'],
            'country_id' => ['required', 'integer']
        ]);

        $type = new Province();
        $type->name = $request->name;
        $type->country_id = $request->country_id;
        $type->save();

        Notify::CreateNotify();
        return to_route('admin.province.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) :View
    {
        $countries = Country::all();
        $province = Province::findOrFail($id);
        return view('admin.location.province.edit', compact(
            'countries',
            'province'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:countries,name'],
            'country_id' => ['required', 'integer']
        ]);

        $type = Province::findOrFail($id);
        $type->name = $request->name;
        $type->country_id = $request->country_id;
        $type->save();

        Notify::UpdateNotify();
        return to_route('admin.province.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Province::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
