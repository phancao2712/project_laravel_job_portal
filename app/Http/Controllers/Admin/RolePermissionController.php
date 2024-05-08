<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware(['permission: access management']);
    }
    public function index(): View
    {

        $query = Role::query();

        $this->search($query, ['name']);

        $roles = $query->paginate(10);
        return view('admin.access_management.role.index', compact(
            'roles'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy('group');
        return view('admin.access_management.role.create', compact(
            'permissions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50', 'unique:roles,name']
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        Notify::CreateNotify();

        return to_route('admin.role-permission.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permissions = Permission::all()->groupBy('group');
        $role = Role::findOrFail($id);
        $rolePermissions = $role->permissions;
        $rolePermission = $rolePermissions->pluck('name')->toArray();
        return view('admin.access_management.role.edit', compact(
            'permissions',
            'role',
            'rolePermission'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:50', 'unique:roles,name,'.$id]
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name, 'guard'=> 'admin']);

        $role->syncPermissions($request->permissions);

        Notify::UpdateNotify();

        return to_route('admin.role-permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'Success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
