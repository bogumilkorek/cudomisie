<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Carbon\Carbon;
use App\Mail\OrderCreated as OrderCreatedMail;

class SendOrderDetails
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
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
      return 'debug';

        $when = Carbon::now()->addMinutes(1);

        Mail::to($event->order->email)
        ->later($when, new OrderCreatedMail($event->order));
    }
}
