<?php

namespace Tests\Browser;

use App\User;
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
      $browser->loginAs(User::find(1))
      ->visit(route('products.create'))
      ->assertSee(__('Add new product'))
      ->type('title', 'Test product')
      ->select('categories[]')
      ->select('categories[]');
      $browser->driver->executeScript('$("textarea.editor").val("Test content");');
      $browser->type('price', '20.00 zł')
      ->type('dimensions', '20x20 cm');
      $browser->driver->executeScript("
      window.scrollTo(0,document.body.scrollHeight);
      fakeFileInput = window.$('<input/>')
      .attr({id: 'fake', type:'file'}).appendTo('body');");
      $browser->attach("#fake", public_path("photos/upload/mock-1.jpg"));
      $browser->driver->executeScript("
      var fileList = $('#fake').prop('files');
      $('#fake').hide();
      var e = jQuery.Event('drop', { dataTransfer : { files : fileList } });
      $('.dropzone')[0].dropzone.listeners[0].events.drop(e)
      ");
      $browser->click('button[type=submit]');
      $browser->waitForText(__('Success'));    
    });
  }
}
