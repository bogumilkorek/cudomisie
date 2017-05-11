<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Order;
use Przelewy24;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use App\Notifications\OrderStatusChanged;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
  public function pay(Order $order, Request $request)
  {
    $sessionId = uniqid();
    $amount = number_format((floatval($order->total_cost) * (1 + (floatval(env('PRZELEWY24_COMMISSION')) / 100))), 2) * 100;

    $request->session()->put('order.session_id', $sessionId);
    $request->session()->put('order.id', $order->id);
    $request->session()->put('order.uuid', $order->uuid);
    $request->session()->put('order.total_cost', $order->total_cost);
    $request->session()->put('order.status', $request->paymentMethodName);

    $values = [
      'p24_session_id' => $sessionId,
      'p24_amount' => $amount,
      'p24_currency' => env('PRZELEWY24_CURRENCY'),
      'p24_description' => env('PRZELEWY24_DESCRIPTION'),
      'p24_email' => $order->email,
      'p24_country' => env('PRZELEWY24_COUNTRY'),
      'p24_url_return' => env('PRZELEWY24_URL_RETURN'),
      'p24_url_status' => env('PRZELEWY24_URL_STATUS'),
    ];

    foreach($values as $index => $value)
    Przelewy24::addValue($index, $value);

    $payment = new Payment;
    $payment->session_id = $sessionId;
    $payment->order_uuid = $order->uuid;
    $payment->amount = $amount;
    $payment->save();

    $register = Przelewy24::trnRegister(true);

    print_r($register);
  }


  public function paymentStatus(Request $request)
  {
    Log::info('Payment status called');
    if(isset($request->p24_session_id))
    {
      $payment = Payment::where('session_id', $request->p24_session_id)->firstOrFail();
      $payment->order_id = $request->p24_order_id;
      $payment->method = $request->p24_method;

      $values = [
        'p24_session_id' => $request->p24_session_id,
        'p24_amount' => $request->p24_amount,
        'p24_currency' => $request->p24_currency,
        'p24_order_id' => $request->p24_order_id,
      ];

      foreach($values as $index => $value)
      Przelewy24::addValue($index, $value);

      $res = Przelewy24::trnVerify();

      if(isset($res["error"]) and $res["error"] === '0')
      {
        Log::info('Payment verified');
        $payment->verified = 1;
        $order = Order::where('uuid', $payment->order_uuid)->firstOrFail();

        $order->order_status_id = 2;
        $order->update();

        $when = Carbon::now()->addSeconds(30);
        $order->notify((new OrderStatusChanged($order))->delay($when));
      }
      else
      {
        Log::info('Payment error');
        $payment->error = 1;
      }
      $payment->update();
      Log::info('Payment saved');
    }
  }

  public function paymentCallback(Request $request)
  {
    $sessionId = $request->session()->get('order.session_id');

    if(!$sessionId)
    {
      abort(404);
    }
    else
    {
      $payment = Payment::where('session_id', $sessionId)->first();
      if(!$payment)
      abort(404);
    }

    return view('orders.verify')
    ->withSessionId($sessionId);

  }

  public function paymentCompleted(Request $request)
  {
    $id = $request->session()->get('order.id');

    if(!$id)
    {
      abort(404);
    }

    $uuid = $request->session()->get('order.uuid');
    $status = $request->session()->get('order.status');
    $total_cost = $request->session()->get('order.total_cost');
    $request->session()->forget('order');

    return view('orders.completed')
    ->withId($id)
    ->withUuid($uuid)
    ->withStatus($status)
    ->withTotalCost($total_cost);
  }

  public function paymentError(Request $request)
  {

    $id = $request->session()->get('order.id');

    if(!$id)
    {
      abort(404);
    }

    $request->session()->forget('order');

    return view('orders.paymentError')
    ->withId($id);
  }

  public function paymentCheck(Request $request)
  {
    $id = $request->session()->get('order.id');

    if(!$id)
    return [
      'message' => 'Session data is not set!',
    ];
    else if(!$request->id)
    return [
      'message' => 'No data provided',
    ];
    else
    {
      $payment = Payment::where('session_id', $request->id)->first();

      if(!$payment)
      return [
        'message' => 'Payment not found',
      ];
      else
      {
        if($payment->error)
        return [
          'message' => 'Payment error',
        ];
        if(!$payment->verified)
        return [
          'message' => 'Payment not verified',
        ];
        else
        return [
          'message' => 'Payment verified',
        ];
      }
    }
  }
}
