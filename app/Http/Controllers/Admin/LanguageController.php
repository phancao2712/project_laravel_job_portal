<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CandidateLanguage;
use App\Models\Language;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LanguageController extends Controller
{
    use Searchable;
    function __construct(){
        $this->middleware(['permission: job attributes']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Language::query();

        $this->search($query, ['name']);

        $languages = $query->paginate(10);

        return view('admin.language.index', compact(
            'languages'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:languages,name']
        ]);

        $type = new Language();
        $type->name = $request->name;
        $type->save();

        Notify::CreateNotify();
        return to_route('admin.languages.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $language = Language::findOrFail($id);
        return view('admin.language.edit', compact(
            'language'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:languages,name']
        ]);

        $type = Language::findOrFail($id);
        $type->name = $request->name;
        $type->save();

        Notify::UpdateNotify();
        return to_route('admin.languages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $candidateExist = CandidateLanguage::where('language_id', $id)->exists();
        if ($candidateExist) {
            return response(['message' => 'error'], 500);
        }
        try {
            Language::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
