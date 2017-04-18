<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactForm;
use Carbon\Carbon;

class EmailController extends Controller
{
    public function contactForm(Request $request)
    {
      $when = Carbon::now()->addMinutes(1);

      Mail::to($request->email)
      ->later($when, new ContactForm($request));

      alert()->success(__('Your e-mail has been sent'), __('Success'))->persistent('OK');
      return redirect()->route('user.homepage.show');
    }
}
