<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Product;


class LatestProductComposer
{
  public function compose(View $view)
  {
      // Get 6 latest active products and attach it to a view
      $latestProducts = Product::orderBy('id', 'desc')
      ->with('categories')
      ->with('images')
      ->withTrashed()
      ->take(6)
      ->get();

      $view->with('latestProducts', $latestProducts);
  }
}
