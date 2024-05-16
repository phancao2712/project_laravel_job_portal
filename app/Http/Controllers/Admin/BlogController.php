<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogStoreRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\Blog;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BlogController extends Controller
{
    use FileUploadTrait, Searchable;
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware(['permission: blogs']);
    }
    public function index(): View
    {
        $query = Blog::query();
        $this->search($query, ['title', 'slug']);

        $blogs = $query->latest()->paginate(20);
        return view('admin.blog.index', compact(
            'blogs'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStoreRequest $request)
    {
        $imagePath = $this->uploadFile($request, 'image');

        $blog = [];
        $blog['image'] = $imagePath;
        $blog['title'] = $request->title;
        $blog['description'] = $request->description;
        $blog['author_id'] = auth()->guard('admin')->user()->id;

        Blog::create(
            $blog
        );

        Notify::CreateNotify();
        return to_route('admin.blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function changeStatus(string $id): Response
    {
        $blog = Blog::FindOrFail($id);
        $blog->status = $blog->status == 0 ? 1 : 0;
        $blog->save();
        Notify::UpdateNotify();
        return response(['message' => 'success', 200]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact(
            'blog'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, string $id)
    {
        $data = [];
        $blog = Blog::findOrFail($id);

        $imagePath = $this->uploadFile($request, 'image', $blog?->image);
        if ($imagePath) $data['image'] = $imagePath;
        $data['image'] = $imagePath;
        $data['title'] = $request->title;
        $data['description'] = $request->description;

        $blog->updateOrCreate(
            ['author_id' => auth()->guard('admin')->user()->id],
            $data
        );

        Notify::UpdateNotify();
        return to_route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            // deleteFile($blog->image);
            $blog->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
