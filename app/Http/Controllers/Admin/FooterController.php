<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FooterController extends Controller
{
    use FileUploadTrait;
    function __construct(){
        $this->middleware(['permission: site footer']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $footer = Footer::first();
        return view('admin.footer.index', compact(
            'footer'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'description' => ['required','max:255'],
            'image' => ['nullable','max:2000'],
            'copyright' => ['required', 'max:50']
        ]);

        $formData = [];

        $oldPath = Footer::where('id',$id)->select('logo')->first();
        $imagePath = $this->uploadFile($request,'image',$oldPath?->logo);

        if($imagePath) $formData['logo'] = $imagePath;
        $formData['description'] = $request->description;
        $formData['copyright'] = $request->copyright;

        Footer::updateOrCreate(
            ['id' => 1],
            $formData
        );
        Notify::UpdateNotify();
        return redirect()->back();
    }
}
