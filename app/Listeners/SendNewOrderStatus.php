<?php

namespace App\Listeners;

use App\Events\OrderStatusUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Carbon\Carbon;
use App\Mail\OrderStatusUpdated as OrderStatusUpdatedMail;

class SendNewOrderStatus implements ShouldQueue
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
      $when = Carbon::now()->addMinutes(1);

      Mail::to($event->order->email)
      ->later($when, new OrderStatusUpdatedMail($event->order));
    }
}
