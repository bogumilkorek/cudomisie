<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingMethodRequest;
use App\ShippingMethod;
use App\Product;
use Illuminate\Http\Request;
use Alert;

class ShippingMethodController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'admin']);
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $shippingMethods = ShippingMethod::orderBy('title', 'asc')->get();
    return view('shippingMethods.index')->withShippingMethods($shippingMethods);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('shippingMethods.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \App\Http\Requests\ShippingMethodRequest  $request
  * @return \Illuminate\Http\Response
  */
  public function store(ShippingMethodRequest $request)
  {
    $shippingMethod = ShippingMethod::create($request->all());

    foreach(Product::all() as $product)
      $product->shippingMethods()->sync($shippingMethod->id, false);

    alert()->success( __('Shipping method created!'), __('Success'))->persistent('OK');
    return redirect()->route('shippingMethods.index');
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Posts  $Posts
  * @return \Illuminate\Http\Response
  */
  public function edit(ShippingMethod $shippingMethod)
  {
    return view('shippingMethods.edit')->withShippingMethod($shippingMethod);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \App\Http\Requests\ShippingMethodRequest  $request
  * @param  \App\ShippingMethod  $shippingMethod
  * @return \Illuminate\Http\Response
  */
  public function update(ShippingMethodRequest $request, ShippingMethod $shippingMethod)
  {
    $shippingMethod->update($request->all());
    alert()->success( __('Shipping method updated!'), __('Success'))->persistent('OK');
    return redirect()->route('shippingMethods.index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\ShippingMethod  $shippingMethod
  * @return \Illuminate\Http\Response
  */
  public function destroy(ShippingMethod $shippingMethod)
  {
    $shippingMethod->delete();

    alert()->success( __('Shipping method deleted!'), __('Success'))->persistent('OK');
    return redirect()->route('shippingMethods.index');
  }
}
