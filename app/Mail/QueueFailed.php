<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\Events\JobFailed;

class QueueFailed extends Mailable implements ShouldQueue
{
  use Queueable, SerializesModels;

  public $connectionName, $job, $exception;
  /**
  * Create a new message instance.
  *
  * @return void
  */

  public function __construct(JobFailed $event)
  {
    $this->job = $event->job->getRawBody();
    $this->exception = $event->exception->getMessage();
    $this->connectionName = $event->connectionName;
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
