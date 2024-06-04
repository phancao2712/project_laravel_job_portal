<?php

namespace App\Http\Controllers\Frontend;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LangController extends Controller
{
    public function changeLang(string $lang)
    {
        App::setLocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
