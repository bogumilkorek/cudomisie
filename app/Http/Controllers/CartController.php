<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
  public function show(Request $request)
  {
    print_r($request->session()->get('cart.items'));
  }
  public function addItem(Request $request, Product $product)
  {
  //  $request->session()->get('cart.items');
      //$request->session()->push('cart.items', $product->slug);
  }
  public function removeItem(Request $request)
  {
      $request->session()->pop('cart.items', $product);
  }
  public function update(Request $request)
  {
      //
  }
  public function clear(Request $request)
  {
      $request->session()->flush();
  }
}
