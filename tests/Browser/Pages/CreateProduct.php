<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class CreateProduct extends Page
{
  /**
  * Get the URL for the page.
  *
  * @return string
  */
  public function url()
  {
    return route('products.create');
  }

  /**
  * Assert that the browser is on the page.
  *
  * @return void
  */
  public function assert(Browser $browser)
  {
    $browser->assertSee(__('Add new product'));
  }

  /**
  * Get the element shortcuts for the page.
  *
  * @return array
  */
  public function elements()
  {
    return [
      '@submit' => 'button[type=submit]',
    ];
  }

  public function fillForm(Browser $browser)
  {
    $browser->type('title', 'Test product')

    // Select random categories
    ->select('categories[]')
    ->select('categories[]')
    ->select('categories[]');

    // Fill textarea via jQuery (ckeditor hides default textarea)
    $browser->driver->executeScript('$("textarea.editor").val("Test content");');

    $browser->type('price', '20.00 zł')
    ->type('dimensions', '20x20 cm');

    // Append fake input file field to document
    $browser->driver->executeScript("
    window.scrollTo(0,document.body.scrollHeight);
    fakeFileInput = window.$('<input/>')
    .attr({id: 'fake', type:'file'})
    .appendTo('body');
    ");

    // Use created fake input to attach mock image
    $browser->attach("#fake", public_path("photos/upload/mock-1.jpg"));

    // Drop mock image to dropzone
    $browser->driver->executeScript("
    var fileList = $('#fake').prop('files');
    $('#fake').hide();
    var e = jQuery.Event('drop', { dataTransfer : { files : fileList } });
    $('.dropzone')[0].dropzone.listeners[0].events.drop(e);
    ");
  }
}
