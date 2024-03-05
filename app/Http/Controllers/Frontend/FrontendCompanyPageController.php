<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendCompanyPageController extends Controller
{
    function index() : View {
        $companies = Company::where(['profile_completion' => 1, 'visibility' => 1])->get();
        return view('frontend.pages.company-page', compact(
            'companies'
        ));
    }
}
