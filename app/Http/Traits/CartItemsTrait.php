<?php
namespace App\Http\Traits;

use Request;
use Response;
use App\Product;

trait CartItemsTrait {
    public function getItems() {
      $items = Request::session()->get('cart.items');
      $products = Product::whereIn('slug', array_keys($items ?? []))
      ->withTrashed()
      ->with('shippingMethods')
      ->get();
      $total = 0;
      $trashed = false;
      foreach($products as $product)
      {
        if($product->trashed())
          $trashed = true;
        $total += floatVal($product->price) * $items[$product->slug];
      }

      $total = (string)$total . ' ' . __('$');

      Request::session()->put('cart.total', $total);

      return [
        'products' => $products,
        'quantities' => $items,
        'total' => $total,
        'trashed' => $trashed,
      ];
    }
}
