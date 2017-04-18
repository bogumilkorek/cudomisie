<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Product;
use App\Http\Traits\CartItemsTrait;


class CartItemsComposer
{

  use CartItemsTrait;

  public function compose(View $view)
  {
    $items = $this->getItems();
    $view->with('items', $items);
  }
}
