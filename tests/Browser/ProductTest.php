<?php

namespace Tests\Browser;

use App\User;
use Tests\Browser\Pages\CreateProduct;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductTest extends DuskTestCase
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
      ->loginAs(User::find(1))
      ->visit(new CreateProduct)
      ->fillForm($browser)
      ->click('@submit')
      ->waitForText(__('Success'))
      ->logout();
    });
  }
}
