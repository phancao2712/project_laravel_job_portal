<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\SendMailRequest;
use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mail;

class ContactPageController extends Controller
{
    public function index() : View {
        return view('frontend.pages.contact-page');
    }

    function sendMail(SendMailRequest $request) {
        Mail::to(config('settings.site_email'))->send(new ContactEmail($request->name,$request->email,$request->subject,$request->message));
        return response(['message' => 'Message send successfully', 200]);
    }
}
