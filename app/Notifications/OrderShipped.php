<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;

class OrderShipped extends Notification implements ShouldQueue
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
    return ['nexmo'];
  }


  public function toNexmo($notifiable)
  {
    return (new NexmoMessage)
    ->from(env('NEXMO_FROM_NAME'))
    ->content(__('Your order no :id has been shipped. Thank you for your business.', ['id' => $this->order->id]) . ' ' . env('APP_NAME'))
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
