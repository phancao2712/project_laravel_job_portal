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
            'image' => ['required','max:2000']
        ]);

        $formData = [];
        $imagePath = $this->uploadFile($request, 'image');

        if($imagePath) $formData['logo'] = $imagePath;
        $formData['description'] = $request->description;

        Footer::updateOrCreate(
            ['id' => 1],
            $formData
        );
        Notify::UpdateNotify();
        return redirect()->back();
    }
}
