<?php

namespace App\Listeners;

use App\Events\OrderStatusUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\OrderStatusUpdated as OrderStatusUpdatedMail;

class SendNewOrderStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderStatusUpdated  $event
     * @return void
     */
    public function handle(OrderStatusUpdated $event)
    {
      Mail::to($event->order->email)
      ->send(new OrderStatusUpdatedMail($event->order));
    }
}
