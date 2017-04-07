<?php
namespace App\Http\Traits;

use Request;
use App\Product;

trait CartItemsTrait {
    public function getItems() {
      $items = Request::session()->get('cart.items');
      $products = Product::whereIn('slug', array_keys($items ?? []))->get();
      $total = 0;

      foreach($products as $product)
        $total += floatVal($product->price);

      return [
        'products' => $products,
        'quantities' => $items,
        'total' => $total,
      ];
    }
}