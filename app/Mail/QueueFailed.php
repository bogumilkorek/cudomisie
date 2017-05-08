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

    public $connectionName, $job, $exeption;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(JobFailed $event)
    {
        $this->connectionName = $event->connectionName;
        $this->job = $event->job;
        $this->exeption = $event->exception;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(env('APP_NAME') . ' - ' . __('queue failed'))
        ->markdown('emails.dev.queueFailed');
    }
}
