<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleUserController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware(['permission: access management']);
    }
    public function index() : View
    {
        $query = Admin::query();

        $this->search($query, ['name','email']);

        $admins = $query->paginate(10);
        return view('admin.access_management.role_user.index', compact(
            'admins'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.access_management.role_user.create', compact(
            'roles'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:admins,email'],
            'role' => ['required'],
            'password' => ['required', 'confirmed']
        ]);

        $user = new Admin();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);

        $user->save();
        $user->assignRole($request->role);

        Notify::CreateNotify();

        return to_route('admin.role-user.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::all();
        return view('admin.access_management.role_user.edit', compact(
            'roles',
            'admin'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:admins,email,'.$id],
            'role' => ['required'],
            'password' => ['confirmed']
        ]);

        $user = Admin::findOrFail($id);
        $user->email = $request->email;
        $user->name = $request->name;
        if($request->password) $user->password = bcrypt($request->password);

        $user->save();
        $user->syncRoles($request->role);

        Notify::UpdateNotify();

        return to_route('admin.role-user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        if($admin->getRoleNames()->first() == 'Super Admin'){
            return response(['message' => 'You can\'t delete super admin'], 500);
        }
        try {
            $admin->delete();
            $admin->removeRole($admin->getRoleNames()->first());
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
