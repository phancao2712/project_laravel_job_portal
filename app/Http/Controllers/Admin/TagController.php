<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobTag;
use App\Models\Tag;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;

class TagController extends Controller
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
       $query = Tag::query();

       $this->search($query, ['name']);

       $tags = $query->orderBy('id', 'DESC')->paginate(10);

       return view('admin.job.tag.index', compact(
        'tags'
       ));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.job.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:skills,name'],
        ]);

        $model = new Tag();
        $model->name = $request->name;
        $model->save();

        Notify::CreateNotify();
        return to_route('admin.tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.job.tag.edit', compact(
            'tag'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:skills,name'],
        ]);

        $model = Tag::findOrFail($id);
        $model->name = $request->name;
        $model->save();

        Notify::UpdateNotify();
        return to_route('admin.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobExist = JobTag::where('tag_id', $id)->exists();
        if ($jobExist) {
            return response(['message' => 'error'], 500);
        }
        try {
            $tag = Tag::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'Success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
