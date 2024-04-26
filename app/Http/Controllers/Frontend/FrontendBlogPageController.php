<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendBlogPageController extends Controller
{
    use Searchable;
    public function index() : View {
        $blogs = Blog::where('status', 1)->latest()->paginate(10);
        return view('frontend.pages.blogs-index', compact(
            'blogs'
        ));
    }

    public function show(string $id) : View {
        $blog = Blog::findOrFail($id);
        return view('frontend.pages.blog-detail', compact(
            'blog'
        ));
    }
}
