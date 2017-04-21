<?php

namespace Tests\Browser;

use Tests\Browser\Pages\Cart;
use Tests\Browser\Pages\CreateOrder;
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
      $browser
      ->visit(new Cart)
      ->addToCart($browser)
      ->visit(new Cart)
      ->assertSee(__('Place order'))
      ->clickLink(__('Place order'))
      ->on(new CreateOrder)
      ->clickLink(__('Buy without creating account'))
      ->fillForm($browser)
      ->click('@submit')
      ->waitForText(__('Success'));
    });
  }
}
