<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class ContactForm extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name, $email, $phone, $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(Request $request)
    {
        $this->name = $request->name;
        $this->email = $request->email;
        $this->phone = $request->phone;
        $this->content = $request->messageContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('New e-mail from') . ' ' . env('APP_NAME'))
        ->markdown('emails.contactform');
    }
}
