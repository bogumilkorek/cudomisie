<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Order;
use App\Product;
use App\ShippingMethod;
use Illuminate\Http\Request;
use Alert;
use App\Http\Traits\CartItemsTrait;

class OrderController extends Controller
{

  use CartItemsTrait;

  public function __construct()
  {
      $this->middleware('auth')->except(['showUser', 'createUser', 'storeUser']);
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

       /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
       public function create()
       {
         return view('orders.create');
       }

       public function createUser()
       {
         $items = $this->getItems();

         return $items;

         return view('orders.createUser')
         ->withItems($items)
         ->withShippingMethods(ShippingMethod::all());
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

         $order = new Order;

        //  $oder->create([
        //    'order_status_id' => 1,
        //    'shipping_method_id' => $request->shippingMethodId,
        //    'shipping_cost' => ShippingMethod::where('id', $request->shipping_method_id)->first()->price,
        //    'total_cost' => 1200.93,
        //    'name' => $request->name,
        //    'email' => $request->email,
        //    'phone' => $request->phone,
        //    'address' => $request->street . ', ' . $request->city,
        //    'comments' => $request->comments,
        //  ]);

         $products = Product::whereIn('id', $request->products)->get();

         return $products;

         alert()->success( __('Order created!'), __('Success'))->persistent('OK');
         return redirect()->route('orders.index');
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
