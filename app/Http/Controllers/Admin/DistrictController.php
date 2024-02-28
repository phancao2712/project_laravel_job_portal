<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\District;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
