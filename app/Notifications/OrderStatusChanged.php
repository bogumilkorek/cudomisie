<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class OrderStatusChanged extends Notification implements ShouldQueue
{
  use Queueable;

  public $tries = 3;

  protected $order;

  /**
  * Create a new notification instance.
  *
  * @return void
  */
  public function __construct($order)
  {
    $this->order = $order;
  }

  /**
  * Get the notification's delivery channels.
  *
  * @param  mixed  $notifiable
  * @return array
  */
  public function via($notifiable)
  {
    return ['mail', 'nexmo'];
  }

  /**
  * Get the mail representation of the notification.
  *
  * @param  mixed  $notifiable
  * @return \Illuminate\Notifications\Messages\MailMessage
  */
  public function toMail($notifiable)
  {
    return (new MailMessage)
    ->subject(__('Cudomisie.pl - order status updated'))
    ->markdown('emails.user.orderStatusUpdated', ['order' => $this->order]);
  }
  
  public function toNexmo($notifiable)
  {
    return (new NexmoMessage)
    ->from(env('NEXMO_FROM_NAME'))
    ->content('Status Twojego zamówienia został zmieniony. Nowy status: ' . $this->order->orderStatus->title)
    ->unicode();
  }

  /**
  * Get the array representation of the notification.
  *
  * @param  mixed  $notifiable
  * @return array
  */
  public function toArray($notifiable)
  {
    return [
      //
    ];
  }
}
