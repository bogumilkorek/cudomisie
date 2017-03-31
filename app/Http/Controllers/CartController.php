<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{

  public function show(Request $request)
  {

    $items = $request->session()->get('cart.items');
    $products = Product::whereIn('slug', array_keys($items ?? []))->get();

    return view('cart.show')->withProducts($products)
    ->withQuantities($items);
  }


  public function addItem(Request $request, Product $product, $quantity = 1)
  {
    $item = 'cart.items.' . $product->slug;

    if($request->session()->has($item))
    {
      $previousQuantity = $request->session()->get($item);
      $quantity += $previousQuantity;
      $request->session()->forget($item);
    }
    $request->session()->put($item, $quantity);
  }


  public function updateItem(Request $request, Product $product, $quantity)
  {
    $item = 'cart.items.' . $product->slug;

    $request->session()->forget($item);
    $request->session()->put($item, $quantity);
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
