<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use FileUploadTrait;
    public function index() : View {
        $admin = auth()->guard('admin')->user();
        return view('admin.profile.index', compact(
            'admin'
        ));
    }

    function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:admins,email,'.$id],
            'image' => ['nullable', 'image', 'max:2500']
        ]);

        $admin = auth()->guard('admin')->user();
        $imagePath = $this->uploadFile($request, 'image');
        if($imagePath) $admin->image = $imagePath;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        Notify::UpdateNotify();

        return to_route('admin.profile.index');
    }

    function passwordUpdate(Request $request, String $id) {
        $request->validate([
            'password' => ['required', 'confirmed']
        ]);
        $admin = auth()->guard('admin')->user();
        $admin->password = bcrypt($request->password);
        $admin->save();
        Notify::UpdateNotify();
        return to_route('admin.profile.index');
    }
}
