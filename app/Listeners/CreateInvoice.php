<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Traits\DigitsToWordsTrait;
use View;
use PDF;

class CreateInvoice implements ShouldQueue
{
  use DigitsToWordsTrait;

  public $tries = 3;

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
  View::share('order', $event->order);
  View::share('cost_words', $this->digitsToWords(floatVal($event->order->total_cost)));
  $pdf = PDF::loadView('pdf.invoice');
  $pdf->setPaper('a4', 'portrait')->save(public_path('files/invoices/' .  __('invoice') . '-' . $event->order->uuid . '.pdf'));
}
}
