<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscribes;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    function store(Request $request) {

        $request->validate([
            'email' => ['required','email','unique:subscribes,email']
        ]);

        $subscribes = new Subscribes();
        $subscribes->email = $request->email;
        $subscribes->save();

        return response(['message' => 'Subscribe successful']);
    }
}
