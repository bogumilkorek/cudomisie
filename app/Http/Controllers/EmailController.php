<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactForm;

class EmailController extends Controller
{
    public function contactForm(Request $request)
    {
      Mail::to($request->email)
      ->send(new ContactForm($request));

      alert()->success(__('Your e-mail has been sent'), __('Success'))->persistent('OK');
      return redirect()->route('user.homepage.show');
    }
}
