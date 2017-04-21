<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use App\ShippingMethod;

class CreateOrder extends Page
{
  /**
  * Get the URL for the page.
  *
  * @return string
  */
  public function url()
  {
    return route('user.orders.create');
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
    return [
      '@submit' => '#submit',
    ];
  }

  public function fillForm(Browser $browser)
  {
    $shippingMethod = ShippingMethod::inRandomOrder()->first()->title;

    $browser->driver->executeScript('window.scrollTo(0, 500);');
    $browser->radio('shippingMethodName', $shippingMethod)
    ->type('name', 'Test Client')
    ->type('email', 'test@test.com')
    ->type('phone', '500500500')
    ->type('street', 'Test 3')
    ->type('city', '00-000 Test')
    ->type('comments', 'Test comments');
    $browser->driver->executeScript('location.href="#submit"');
  }
}
