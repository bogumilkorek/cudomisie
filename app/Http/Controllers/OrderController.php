<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Order;
use Illuminate\Http\Request;
use Alert;

class OrderController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth')->except(['index', 'show']);
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

       /**
       * Store a newly created resource in storage.
       *
       * @param  \App\Http\Requests\OrderRequest  $request
       * @return \Illuminate\Http\Response
       */
       public function store(OrderRequest $request)
       {
         Order::create($request->all());
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
         alert()->success( __('Order deleted!'), __('Success'))->persistent('OK');
         return redirect()->route('orders.index');
       }
}
