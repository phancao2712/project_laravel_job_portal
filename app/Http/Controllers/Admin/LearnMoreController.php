<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearnMore;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LearnMoreController extends Controller
{
    use FileUploadTrait;
    function __construct(){
        $this->middleware(['permission: sections']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $learnMore = LearnMore::first();
        return view('admin.learn_more.index', compact(
            'learnMore'
        ));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable','max:3000'],
            'title' => ['required','max:255'],
            'subtitle' => ['required','max:255'],
            'main_title' => ['required','max:255'],
            'url' => ['nullable']
        ]);

        $formData = [];
        $oldPath = LearnMore::where('id',$id)->select('image')->first();
        $imagePath = $this->uploadFile($request,'image',$oldPath?->image);
        if($imagePath) $formData['image'] = $imagePath;
        $formData['title'] = $request->title;
        $formData['subtitle'] = $request->subtitle;
        $formData['main_title'] = $request->main_title;
        $formData['url'] = $request->url;

        LearnMore::updateOrCreate(
            ['id' => 1],
            $formData
        );
        Notify::UpdateNotify();
        return redirect()->back();
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
