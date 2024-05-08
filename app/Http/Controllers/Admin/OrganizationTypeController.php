<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Organization_type;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\Notify;


class OrganizationTypeController extends Controller
{
    use Searchable;
    function __construct(){
        $this->middleware(['permission: job attributes']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $query = Organization_type::query();

        $this->search($query, ['name']);

        $organization_types = $query->paginate(10);

        return view('admin.organization-type.index', compact(
            'organization_types'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.organization-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:organization_types,name']
        ]);

        $type = new Organization_type();
        $type->name = $request->name;
        $type->save();

        Notify::CreateNotify();
        return to_route('admin.organization-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $organization = Organization_type::findOrFail($id);
        return view('admin.organization-type.edit', compact(
            'organization'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:organization_types,name']
        ]);

        $type = Organization_type::findOrFail($id);
        $type->name = $request->name;
        $type->save();

        Notify::UpdateNotify();
        return to_route('admin.organization-types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $companyExists = Company::where('organization_type_id', $id)->exists();
        if ($companyExists) {
            return response(['message' => 'error'], 500);
        }
        try {
            Organization_type::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
