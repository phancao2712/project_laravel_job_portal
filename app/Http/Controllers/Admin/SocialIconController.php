<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialIcon;
use App\Services\Notify;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocialIconController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware(['permission: site footer']);
    }
    public function index() : View
    {
        $socialIcons = SocialIcon::paginate(20);
        return view('admin.social_icon.index', compact(
            'socialIcons'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.social_icon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required'],
            'url' => ['required']
        ]);

        $data = [];
        $data['icon'] = $request->icon;
        $data['url'] = $request->url;

        SocialIcon::create(
            $data
        );

        Notify::CreateNotify();
        return to_route('admin.social-icons.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $socialIcon = SocialIcon::findOrFail($id);
        return view('admin.social_icon.edit', compact(
            'socialIcon'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required'],
            'url' => ['required']
        ]);

        $data = [];
        $data['icon'] = $request->icon;
        $data['url'] = $request->url;

        SocialIcon::updateOrCreate(
            ['id' => $id],
            $data
        );

        Notify::UpdateNotify();
        return to_route('admin.social-icons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $socialIcon = SocialIcon::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'Success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
