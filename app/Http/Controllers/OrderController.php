<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\User;
use App\Order;
use App\OrderStatus;
use App\Product;
use App\ShippingMethod;
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

class OrderController extends Controller
{

  use CartItemsTrait;

  public function __construct()
  {
    $this->middleware(['auth', 'admin'])->except(['indexUser', 'showUser', 'createUser', 'storeUser']);
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

    if($cashOnDelivery != 1)
      $order->order_status_id = 1;
    else
      $order->order_status_id = 2;

    $order->shipping_method_name = $request->shippingMethodName;
    $order->shipping_cost = ShippingMethod::where('title', $request->shippingMethodName)->first()->price;
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

    return view('orders.completed')
    ->withId($order->id)
    ->withUuid($order->uuid)
    ->withTotalCost($order->total_cost)
    ->withCashOnDelivery($cashOnDelivery);
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
}
