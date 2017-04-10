<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Traits\CartItemsTrait;

class CartController extends Controller
{

  use CartItemsTrait;

  public function show()
  {

    $items = $this->getItems();

    return view('cart.show')
    ->withItems($items);
  }

  public function addItem(Request $request)
  {
    $item = 'cart.items.' . $request->slug;
    $quantity = $request->quantity;

    if($request->session()->has($item))
    {
      $previousQuantity = $request->session()->get($item);
      $quantity += $previousQuantity;
      $request->session()->forget($item);
    }
    $request->session()->put($item, $quantity);

    return [
      'title' => __('Success'),
      'content' => __('Item added to cart'),
    ];
  }

  public function updateItem(Request $request)
  {
    $item = 'cart.items.' . $request->slug;
    $quantity = $request->quantity;

    $request->session()->forget($item);
    $request->session()->put($item, $quantity);

    return [
      'title' => __('Success'),
      'content' => __('Cart updated'),
    ];
  }

public function removeItem(Request $request)
  {
    $item = 'cart.items.' . $request->slug;

    $request->session()->forget($item);

    return [
      'title' => __('Success'),
      'content' => __('Item removed from cart'),
    ];
  }

  public function clear(Request $request)
  {
    $request->session()->forget('cart');

    return [
      'title' => __('Success'),
      'content' => __('Cart cleared'),
    ];
  }

}
