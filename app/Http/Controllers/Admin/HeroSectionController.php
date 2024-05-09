<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use FileUploadTrait;
    function __construct(){
        $this->middleware(['permission: sections']);
    }
    public function index() : View
    {
        $hero = Hero::first();
        return view('admin.hero-section.index', compact(
            'hero'
        ));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'sub_title' => ['required', 'max:255'],
            'image' => ['nullable','image','max:3000'],
            'backgroundImage' => ['nullable','image','max:3000'],
        ]);

        $formData = [];
        $oldPath = Hero::where('id',$id)->select('image', 'background_image')->first();
        $imagePath = $this->uploadFile($request, 'image', $oldPath?->image);
        $backgroundImagePath = $this->uploadFile($request, 'backgroundImage', $oldPath?->backgroundImage);
        if($imagePath) $formData['image'] = $imagePath;
        if($backgroundImagePath) $formData['background_image'] = $backgroundImagePath;
        $formData['title'] = $request->title;
        $formData['sub_title'] = $request->sub_title;

        $hero = Hero::updateOrCreate(
            ['id' => 1],
            $formData
        );

        Notify::UpdateNotify();

        return redirect()->back();
    }

}
