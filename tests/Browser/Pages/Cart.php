<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use App\Product;

class Cart extends Page
{
  /**
  * Get the URL for the page.
  *
  * @return string
  */
  public function url()
  {
    return route('cart.show');
  }

  /**
  * Assert that the browser is on the page.
  *
  * @return void
  */
  public function assert(Browser $browser)
  {
  }

  /**
  * Get the element shortcuts for the page.
  *
  * @return array
  */
  public function elements()
  {
    $itemToBuy = Product::orderBy('id', 'desc')->first()->slug;

    return [
      '@buy' => 'a[data-slug="' . $itemToBuy . '"]',
    ];
  }

  public function addToCart(Browser $browser)
  {
    $browser->driver->executeScript('window.scrollTo(0, 500);');
    $browser->click('@buy');
  }

}
