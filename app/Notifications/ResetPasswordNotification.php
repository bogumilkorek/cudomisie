<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
  use Queueable;

  public $tries = 3;

  public $token;

  public function __construct($token)
  {
    $this->token = $token;
  }

  public function via($notifiable)
  {
    return ['mail'];
  }

  public function toMail($notifiable)
  {
    return (new MailMessage)
    ->subject(env('APP_NAME') . ' - ' . __('reset password'))
    ->markdown('emails.user.resetPassword', ['url' => url('password/reset', $this->token)]);
  }

}
