<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
  public function show(Request $request)
  {
    return view('cart.show')->withItems($request->session()->get('cart.items'));
  }
  public function addItem(Request $request, Product $product)
  {
    $quantity = 1;
    if($request->session()->has('cart.items.' . $product->slug))
    {
      $currentQuantity = $request->session()->get('cart.items.' . $product->slug);
      $request->session()->forget('cart.items.' . $product->slug);
    }
    $quantity += $currentQuantity ?? 0;
    $request->session()->put('cart.items.' . $product->slug, $quantity);
  }
  public function removeItem(Request $request)
  {
    $request->session()->forget('cart.items.' . $product->slug);
  }
  public function clear(Request $request)
  {
    $request->session()->flush();
  }
}
