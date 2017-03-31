<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{

  public function show(Request $request)
  {
    $products = Product::whereIn('slug', array_keys($request->session()->get('cart.items') ?? []))->get();

    return view('cart.show')->withProducts($products)
    ->withQuantities($request->session()->get('cart.items'));
  }


  public function addItem(Request $request, Product $product, $quantity = 1)
  {
    if($request->session()->has('cart.items.' . $product->slug))
    {
      $previousQuantity = $request->session()->get('cart.items.' . $product->slug);
      $quantity += $previousQuantity;
      $request->session()->forget('cart.items.' . $product->slug);
    }
    $request->session()->put('cart.items.' . $product->slug, $quantity);
  }


  public function updateItem(Request $request, Product $product, $quantity)
  {
    $request->session()->forget('cart.items.' . $product->slug);
    $request->session()->put('cart.items.' . $product->slug, $quantity);
  }


  public function removeItem(Request $request)
  {
    $request->session()->forget('cart.items.' . $product->slug);
  }


  public function clear(Request $request)
  {
    $request->session()->forget('cart');
  }

}
