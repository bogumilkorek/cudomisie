<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use View;
use PDF;

class CreateInvoice implements ShouldQueue
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

    public function digitsToWords($number)
    {
    $number = number_format($number,2,",","");
  	$output = NULL;
  	$highestwordarray = array(
  		0 => array(1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "", 7 => "", 8 => "", 9 => "" , 0 => ""),
  		1 => array(1 => "tysiąc.", 2 => "tys.", 3 => "tys.", 4 => "tys.", 5 => "tys.", 6 => "tys.", 7 => "tys.", 8 => "tys.", 9 => "tys." , 0 => "tys."),
  		2 => array(1 => "mil.", 2 => "mil.", 3 => "mil.", 4 => "mil.", 5 => "mil.", 6 => "mil.", 7 => "mil.", 8 => "mil.", 9 => "mil." , 0 => "mil."),
  		3 => array(1 => "miliard", 2 => "mld.", 3 => "mld.", 4 => "mld.", 5 => "mld.", 6 => "mld.", 7 => "mld.", 8 => "mld.", 9 => "mld." , 0 => "mld."),
  		);
  	$digitstoword = array(
  		0 => array(1 => 'jeden', 2 => 'dwa', 3 => 'trzy', 4 => 'cztery', 5 => 'pięć', 6 => 'sześć', 7 => 'siedem', 8 => 'osiem', 9 => 'dziewięć', 0 => ''),
  		1 => array(1 => array(1 => 'jedenaście', 2 => 'dwanaście', 3 => 'trzynaście', 4 => 'czternaście', 5 => 'piętnaście', 6 => 'szesnaście', 7 => 'siedemnaście', 8 => 'osiemnaście', 9 => 'dziewiętnaście', 0 => 'dziesięć'), 2 => 'dwadzieścia', 3 => 'trzydzieści', 4 => 'czterdzieści', 5 => 'pięćdziesiąt', 6 => 'sześćdziesiąt', 7 => 'siedemdziesiąt', 8 => 'osiemdziesiąt', 9 => 'dziewięćdziesiąt', 0 => ''),
  		2 => array(1 => 'sto', 2 => 'dwieście', 3 => 'trzysta', 4 => 'czterysta', 5 => 'pięćset', 6 => 'sześćset', 7 => 'siedemset', 8 => 'osiemset', 9 => 'dziewięćset', 0 => ''),
  		);

  	$number = explode(",",$number);
  	$number[1] = $number[1][1].$number[1][0];
  	$total_numbers = strlen($number[0])-1;
  	$part = NULL;

  	for($i = 0; $i <= $total_numbers; $i++) {		if(strlen($part) == 3 or strlen($part) == 7 or strlen($part) == 11) {
  			$part .= " ";
  		}
  		$part .= $number[0][$total_numbers - $i];
  	}

  	$number[0] = explode(" ",$part);

  	$word = array("0" => NULL, 1 => NULL, 2 => NULL, 3 => NULL, 'gr' => NULL);
  	foreach($number[0] as $key => $val) {
  		if(isset($val[2])) {
  			$word[$key] .= " ".$digitstoword[2][$val[2]];
  		}
  		if(isset($val[1])) {
  			if($val[1] == 1) {
  				$word[$key] .= " ".$digitstoword[1][$val[1]][$val[0]];
  			}
  			else {
  				$word[$key] .= " ".$digitstoword[1][$val[1]];
  			}

  			if(isset($val[0]) and (!isset($val[1]) or $val[1] != '1')) {
  				$word[$key] .= " ".$digitstoword[0][$val[0]];
  			}
  		}
  	}

  	for($i = 0; $i <= count($number[0])-1; $i++) {		if(isset($highestwordarray[$i][$number[0][$i][3 - 	strlen($number[0][$i])]]) and strlen($number[0][$i])-1 >= 0) {
  			$output = $word[$i]." ".$highestwordarray[$i][$number[0][$i][3 - strlen($number[0][$i])]]." ".$output;
  		}
  	}

  	$key = 'gr';
  	if(isset($number[1][1]))
  		if($number[1][1] == 1) {
  			$word[$key] .= " ".$digitstoword[1][$number[1][1]][$number[1][0]];
  		}
  		else {
  			$word[$key] .= " ".$digitstoword[1][$number[1][1]];
  		}

  	if(isset($number[1][0]) and (!isset($number[1][1]) or $number[1][1] != '1')) {
  		$word[$key] .= " ".$digitstoword[0][$number[1][0]];
  	}

  	return($output." zł. i ".$word['gr']." gr.");
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
        return $pdf->setPaper('a4', 'portrait')->save(public_path('files/invoices/' .  __('invoice') . '-' . $event->order->uuid . '.pdf'));
    }
}
