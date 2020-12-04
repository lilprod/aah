<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendContactMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'firstname' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $name = $request->name;
        $firstname = $request->firstname;
        $phone_number = $request->phone_number;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;

        Mail::to('aahafricahealthcare@gmail.com')->send(new SendContactMail($name, $firstname, $phone_number, $email, $subject, $message));

        return redirect()->route('contact')->with('success', 'Message envoyé avec succès!');
    }
}
