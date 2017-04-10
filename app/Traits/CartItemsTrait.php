<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Product;

trait GetCartItemsTrait {
    public function getItems() {
      $items = $request->session()->get('cart.items');
      $products = Product::whereIn('slug', array_keys($items ?? []))->get();
      $ids = $products->lists('id')->toArray();
      $total = 0;

      foreach($products as $product)
        $total += floatVal($product->price);

      return [
        'products' => $products,
        'ids' => $ids,
        'quantities' => $items,
        'total' => $total,
      ]
    }
}
