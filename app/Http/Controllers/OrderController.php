<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Order;
use App\Product;
use App\ShippingMethod;
use Illuminate\Http\Request;
use Alert;
use App\Http\Traits\CartItemsTrait;
use Illuminate\Support\Facades\Auth;

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
    $orders = Order::orderBy('id', 'desc')
    ->with('orderStatus')
    ->with('shippingMethod')
    ->get();

    return view('orders.index')->withOrders($orders);
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
    $buyWithoutLogin = $request->noaccount ?? null;

    $request->session()->put('shopping', 'true');

    $items = $this->getItems();

    return view('orders.createUser')
    ->withItems($items)
    ->withShippingMethods(ShippingMethod::all())
    ->withBuyWithoutLogin($buyWithoutLogin);
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

    $order = new Order;
    if(Auth::user()->id)
        $order->user_id = Auth::user()->id;
    $order->order_status_id = 1;
    $order->shipping_method_id = $request->shippingMethodId;
    $order->shipping_cost = ShippingMethod::where('id', $request->shippingMethodId)->first()->price;
    $order->total_cost = (string)(floatval($items['total']) + floatval($order->shipping_cost)) . ' ' . __('$');
    $order->name = $request->name;
    $order->email = $request->email;
    $order->phone = $request->phone;
    $order->address = $request->street . ', ' . $request->city;
    $order->comments = $request->comments;
    $order->save();

    foreach($items['products'] as $product)
    $order->products()->attach($product->id, [
      'product_title' => $product->title,
      'product_quantity' => $items['quantities'][$product->slug],
      'product_price' => $product->price,
    ]);

    $request->session()->forget('cart');

    return view('orders.completed')
    ->withId($order->id)
    ->withUuid($order->uuid)
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
    return view('orders.edit')->withOrder($order);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \App\Http\Requests\OrderRequest  $request
  * @param  \App\Order  $order
  * @return \Illuminate\Http\Response
  */
  public function update(OrderRequest $request, Order $order)
  {
    $order->update($request->all());
    alert()->success( __('Order updated!'), __('Success'))->persistent('OK');
    return redirect()->route('orders.index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Order  $order
  * @return \Illuminate\Http\Response
  */
  public function destroy(Order $order)
  {
    $order->delete();
    alert()->success(__('Order deleted!'), __('Success'))->persistent('OK');
    return redirect()->route('orders.index');
  }
}
