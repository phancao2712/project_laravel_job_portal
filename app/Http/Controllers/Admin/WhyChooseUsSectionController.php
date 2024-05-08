<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseUsSection;
use App\Services\Notify;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WhyChooseUsSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware(['permission: sections']);
    }
    public function index() : View
    {
        $sections = WhyChooseUsSection::first();
        return view('admin.why-choose-us.index', compact(
            'sections'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon_1' => ['required','max:255'],
            'title_1' => ['required','max:255'],
            'subtitle_1' => ['required','max:255'],
            'icon_2' => ['required','max:255'],
            'title_2' => ['required','max:255'],
            'subtitle_2' => ['required','max:255'],
            'icon_3' => ['required','max:255'],
            'title_3' => ['required','max:255'],
            'subtitle_3' => ['required','max:255'],
        ]);

        $section = new WhyChooseUsSection();
        $section->updateOrCreate(
            ['id' => 1],
            $request->all()
        );

        Notify::UpdateNotify();
        return to_route('admin.whyChooseUs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
