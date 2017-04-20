<?php

namespace Tests\Browser;

use App\Product;
use App\ShippingMethod;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OrderTest extends DuskTestCase
{
  /**
  * A Dusk test example.
  *
  * @return void
  */
  public function testExample()
  {
    $this->browse(function (Browser $browser) {

      $itemToBuy = Product::orderBy('id', 'desc')->first()->slug;
      $shippingMethod = ShippingMethod::inRandomOrder()->first()->title;

      $browser->visit('/' . __('cart'));
      $browser->driver->executeScript('window.scrollTo(0, 500);');
      $browser->click('a[data-slug="' . $itemToBuy . '"]')
      ->visit('/' . __('cart'))
      ->assertSee(__('Place order'))
      ->clickLink(__('Place order'))
      ->assertPathIs('/' . __('place-order'))
      ->clickLink(__('Buy without creating account'));
      $browser->driver->executeScript('window.scrollTo(0, 500);');
      $browser->radio('shippingMethodName', $shippingMethod)
      ->type('name', 'Test Client')
      ->type('email', 'test@test.com')
      ->type('phone', '500500500')
      ->type('street', 'Test 3')
      ->type('city', '00-000 Test')
      ->type('comments', 'Test comments');
      $browser->driver->executeScript('location.href="#submit"');
      $browser->click('#submit');
      $browser->waitForText(__('Success'));
    });
  }
}
