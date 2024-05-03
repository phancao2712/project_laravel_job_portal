<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutUsPageController extends Controller
{
    public function index() : View {
        $aboutUs = AboutUs::first();
        $blogs = Blog::take(6)->get();

        return view('frontend.pages.about-us-page', compact(
            'aboutUs',
            'blogs'
        ));
    }
}
