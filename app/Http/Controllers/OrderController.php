<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\User;
use App\Order;
use App\OrderStatus;
use App\Product;
use App\ShippingMethod;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Alert;
use Carbon\Carbon;
use App\Http\Traits\CartItemsTrait;
use Illuminate\Support\Facades\Auth;
use App\Events\OrderCreated;
use Illuminate\Notifications\Notifiable;
use App\Notifications\OrderStatusChanged;
use App\Notifications\OrderShipped;
use Illuminate\Support\Facades\File;
use Przelewy24;

class OrderController extends Controller
{

  use CartItemsTrait;

  public function __construct()
  {
    $this->middleware(['auth', 'admin'])->except(['indexUser', 'showUser', 'createUser', 'storeUser', 'pay', 'payStatus', 'payCallback']);
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {

    $orderStatuses = OrderStatus::all();

    $orders = Order::orderBy('id', 'desc')
    ->with('orderStatus')
    ->with('shippingMethod')
    ->with('paymentMethod')
    ->get();

    return view('orders.index')
    ->withOrders($orders)
    ->withOrderStatuses($orderStatuses);
  }

  public function indexUser()
  {
    $orders = Order::where('user_id', Auth::user()->id)
    ->orderBy('id', 'desc')
    ->with('orderStatus')
    ->with('shippingMethod')
    ->get();

    return view('orders.indexUser')->withOrders($orders);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('orders.create');
  }

  public function createUser(Request $request)
  {
    $previousData = false;

    $buyWithoutLogin = $request->noaccount ?? null;

    $request->session()->put('shopping', 'true');

    $cartItemsCounter = $request->session()->get('cart.counter');

    if(!isset($cartItemsCounter))
    return redirect()->route('cart.show');

    $items = $this->getItems();

    // Determine allowed shipping methods
    $allowedSMethods = [];
    foreach($items['products'] as $product)
    foreach($product->shippingMethods as $sMethod)
    $allowedSMethods[] = $sMethod->id;

    if(count($items['products']) > 1)
    $allowedSMethods = array_diff_assoc($allowedSMethods, array_unique($allowedSMethods));

    // Select allowed shipping methods
    $shippingMethods = ShippingMethod::whereIn('id', $allowedSMethods)->get();

    // If shipping method has small capacity then price will be multiplied by item quantity
    foreach($shippingMethods as $sMethod)
    {
      if($sMethod->high_capacity == 0)
      $sMethod->price = (string)((floatval($sMethod->price) * $cartItemsCounter) . ' ' . __('$'));
    }

    if($request->session()->has('cart.order-in-progress'))
    $previousData = $request->session()->get('cart.order-in-progress');

    return view('orders.createUser')
    ->withItems($items)
    ->withShippingMethods($shippingMethods)
    ->withBuyWithoutLogin($buyWithoutLogin)
    ->withPreviousData($previousData);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \App\Http\Requests\OrderRequest  $request
  * @return \Illuminate\Http\Response
  */
  public function store(OrderRequest $request)
  {
  }

  public function storeUser(OrderRequest $request)
  {
    $items = $this->getItems();

    // Store inserted data into session
    if($items['trashed'])
    {
      $request->session()->put('cart.order-in-progress', $request->all());
      return redirect()->route('user.orders.create')->withInput();
    }

    $order = new Order;
    if(isset(Auth::user()->id))
    $order->user_id = Auth::user()->id;

    $cashOnDelivery = ShippingMethod::where('title', $request->shippingMethodName)->first()->cash_on_delivery;

    if($request->paymentMethodName == __('Online payment'))
    {
      // 1 = waiting for payment
      $order->order_status_id = 1;
      $order->payment_method_id = 1;
    }
    else if($cashOnDelivery != 1)
    {
      // 1 = waiting for payment
      $order->order_status_id = 1;
      $order->payment_method_id = 2;
    }
    else
    {
      // 2 = processing
      $order->order_status_id = 2;
      $order->payment_method_id = 3;
    }

    $order->shipping_method_name = $request->shippingMethodName;
    $order->shipping_cost = ShippingMethod::where('title', $request->shippingMethodName)->first()->price;
    if($request->paymentMethodName == __('Online payment'))
    $order->total_cost = (string)(number_format(floatval($items['total']) * (1 + env('PRZELEWY24_COMMISSION') / 100) + floatval($order->shipping_cost), 2)) . ' ' . __('$');
    else
    $order->total_cost = (string)(number_format(floatval($items['total']) + floatval($order->shipping_cost), 2)) . ' ' . __('$');
    $order->name = $request->name;
    $order->email = $request->email;
    $order->phone_number = strpos($request->phone_number, '+48') === false ? '+48' . $request->phone_number : $request->phone_number;
    $order->address = $request->street . ', ' . $request->city;
    $order->comments = $request->comments;
    $order->save();

    foreach($items['products'] as $product)
    $order->products()->attach($product->id, [
      'product_title' => $product->title,
      'product_quantity' => $items['quantities'][$product->slug],
      'product_price' => $product->price,
    ]);

    event(new OrderCreated($order));

    $request->session()->forget('cart');

    $order->products()->delete();

    if($request->paymentMethodName == __('Online payment'))
    $this->pay($order, $request);
    else
    return view('orders.completed')
    ->withId($order->id)
    ->withUuid($order->uuid)
    ->withStatus($order->paymentMethod->title)
    ->withTotalCost($order->total_cost);
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Order  $order
  * @return \Illuminate\Http\Response
  */
  public function show(Order $order)
  {
    return view('orders.show')->withOrder($order);
  }

  public function showUser(Order $order)
  {
    return view('orders.showUser')->withOrder($order);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Order  $order
  * @return \Illuminate\Http\Response
  */
  public function edit(Order $order)
  {
    $shippingMethods = ShippingMethod::all();
    return view('orders.edit')->withOrder($order)
    ->withShippingMethods($shippingMethods);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \App\Http\Requests\OrderRequest  $request
  * @param  \App\Order  $order
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Order $order)
  {
    $order->update($request->all());
    alert()->success(__('Order updated'), __('Success'))->persistent('OK');
    return redirect()->route('orders.index');
  }

  public function updateStatus(Request $request, Order $order)
  {
    $order = Order::where('uuid', $request->uuid)->first();
    $order->order_status_id = $request->order_status_id;
    $order->save();
    $when = Carbon::now()->addSeconds(30);
    $order->notify((new OrderStatusChanged($order))->delay($when));
    if($order->order_status_id == 3)
    $order->notify((new OrderShipped($order))->delay($when));
    return response()->json("Order status updated");
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Order  $order
  * @return \Illuminate\Http\Response
  */
  public function destroy(Order $order)
  {
    if(File::exists(public_path('files/invoices/'  . __('invoice') . '-' . $order->uuid . '.pdf')))
    File::delete(public_path('files/invoices/'  . __('invoice') . '-' . $order->uuid . '.pdf'));
    $order->products()->detach();
    $order->delete();
    alert()->success(__('Order deleted'), __('Success'))->persistent('OK');
    return redirect()->route('orders.index');
  }

  public function pay(Order $order, Request $request)
  {
    $request->session()->put('order.id', $order->id);
    $request->session()->put('order.uuid', $order->uuid);
    $request->session()->put('order.total_cost', $order->total_cost);
    $request->session()->put('order.status', $order->paymentMethod->title);

    $values = [
      'p24_session_id' => $order->uuid,
      'p24_amount' => floatval($order->total_cost) * 100,
      'p24_currency' => 'PLN',
      'p24_description' => 'Zakup produktu w sklepie cudomisie.pl',
      'p24_email' => $order->email,
      'p24_country' => 'PL',
      'p24_url_return' => env('PRZELEWY24_URL_RETURN'),
      'p24_url_status' => env('PRZELEWY24_URL_STATUS'),
    ];

    foreach($values as $index => $value)
    Przelewy24::addValue($index, $value);

    $payment = new Payment;
    $payment->session_id = $order->uuid;
    $payment->amount = floatval($order->total_cost) * 100;
    $payment->save();

    $register = Przelewy24::trnRegister(true);

    //print_r($register);
  }


  public function payStatus(Request $request)
  {
    if(isset($request->p24_session_id))
    {
      $payment = Payment::where('session_id',$request->p24_session_id)->firstOrFail();
      $payment->order_id = $request->p24_order_id;
      $payment->method= $request->p24_method;

      $values = [
        'p24_session_id' => $request->p24_session_id,
        'p24_amount' => $request->p24_amount,
        'p24_currency' => 'PLN',
        'p24_order_id' => $request->p24_order_id,
      ];

      foreach($values as $index => $value)
      Przelewy24::addValue($index, $value);

      $res = Przelewy24::trnVerify();
      if(isset($res["error"]) and $res["error"] === '0')
      {
        $payment->verified = 1;
        $order = Order::where('uuid',$request->p24_session_id)->firstOrFail();

        $order->order_status_id = 2;
        $order->save();

        $when = Carbon::now()->addSeconds(30);
        $order->notify((new OrderStatusChanged($order))->delay($when));
      }
      else if(isset($res["error"]) && ($res["error"] === 'err161' || $res["error"] === 'err162'))
      {
        $payment->cancelled = 1;
      }

      $payment->update();
    }
  }

  public function payCallback(Request $request)
  {
    $id = $request->session()->get('order.id');
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
}
