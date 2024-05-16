<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Industry_type;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\Notify;
use App\Traits\Searchable;

class IndustryTypeController extends Controller
{
    use Searchable;
    function __construct(){
        $this->middleware(['permission: job attributes']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Industry_type::query();

        $this->search($query, ['name']);

        $industry_types = $query->paginate(10);


        return view('admin.industry-type.index', compact(
            'industry_types'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.industry-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:industry_types,name']
        ]);

        $data = [];
        $data['name'] = $request->name;
        Industry_type::create(
            $data
        );

        Notify::CreateNotify();
        return to_route('admin.industry-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $companyExists = Company::where('industry_type_id', $id)->exists();
        if ($companyExists) {
            return response(['message' => 'error'], 500);
        }
        $industry = Industry_type::findOrFail($id);
        return view('admin.industry-type.edit', compact(
            'industry'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:industry_types,name']
        ]);

        $data = [];
        $data['name'] = $request->name;
        Industry_type::create(
            ['id' => $id],
            $data
        );

        Notify::UpdateNotify();
        return to_route('admin.industry-types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Industry_type::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
