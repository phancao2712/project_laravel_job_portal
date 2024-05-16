<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use App\Services\Notify;

class CountryController extends Controller
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
        $query = Country::query();

        $this->search($query, ['name']);

        $countries = $query->orderBy('id', 'DESC')->paginate(20);

        return view('admin.location.country.index', compact(
            'countries'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.location.country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:countries,name']
        ]);
        $data = [];
        $data['name'] = $request->name;
        Country::create(
            $data
        );

        Notify::CreateNotify();
        return to_route('admin.country.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $country = Country::findOrFail($id);
        return view('admin.location.country.edit', compact(
            'country'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:countries,name']
        ]);
        $data = [];
        $data['name'] = $request->name;
        Country::updateOrCreate(
            ['id' => $id],
            $data
        );

        Notify::UpdateNotify();
        return to_route('admin.country.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Country::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
