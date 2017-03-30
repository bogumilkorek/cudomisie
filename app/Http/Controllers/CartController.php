<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
  public function show(Request $request)
  {
    print_r(array_count_values($request->session()->get('cart.items')));
  }
  public function addItem(Request $request, Product $product)
  {
    // $cartItems = $request->session()->get('cart.items') ?? [];
    // if(!in_array($product->slug, array_column($cartItems, 'slug')))
    // $request->session()->push('cart.items', ['slug' => $product->slug, 'quantity' => $request->quantity ?? 1]);
    //print_r($request->session()->get('cart.items'));
    $request->session()->push('cart.items', $product->slug);
  }
  public function removeItem(Request $request)
  {
      $request->session()->pop('cart.items', $product);
  }
  public function clear(Request $request)
  {
      $request->session()->flush();
  }
}
