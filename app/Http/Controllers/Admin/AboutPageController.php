<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutPageController extends Controller
{
    function __construct(){
        $this->middleware(['permission: site pages']);
    }
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $aboutUs = AboutUs::first();
        return view('admin.about_us.index', compact(
            'aboutUs'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable','max:3000'],
            'title' => ['required','max:255'],
            'description' => ['required'],
            'url' => ['nullable']
        ]);

        $oldPath = AboutUs::where('id',$id)->select('image')->first();
        $imagePath = $this->uploadFile($request,'image', $oldPath->image);
        $formData = [];
        if($imagePath) $formData['image'] = $imagePath;
        $formData['title'] = $request->title;
        $formData['description'] = $request->description;
        $formData['url'] = $request->url;

        AboutUs::updateOrCreate(
            ['id' => 1],
            $formData
        );
        Notify::UpdateNotify();
        return redirect()->back();
    }

}
