<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests\EmailRequest;
use App\Mail\ContactForm;
use Carbon\Carbon;

class EmailController extends Controller
{
    public function contactForm(EmailRequest $request)
    {
      $when = Carbon::now()->addSeconds(30);

      Mail::to(env('MAIL_FROM_ADDRESS'))
      ->later($when, new ContactForm($request));

      alert()->success(__('Your e-mail has been sent'), __('Success'))->persistent('OK');
      return redirect()->route('user.homepage.show');
    }

}
