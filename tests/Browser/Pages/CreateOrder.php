<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

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
      '@shippingMethod' => 'input[type=radio]:first-of-type',
    ];
  }

  public function fillForm(Browser $browser)
  {
    $browser->driver->executeScript('window.scrollTo(0, 500);');
    $browser->radio('@shippingMethod', '1')
    ->type('name', 'Test Client')
    ->type('email', 'test@test.com')
    ->type('phone_number', '500500500')
    ->type('street', 'Test 3')
    ->type('city', '00-000 Test')
    ->type('comments', 'Test comments')
    ->check('accept-terms')
    ->check('accept-usage');
    $browser->driver->executeScript('location.href="#submit"');
  }
}
