<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductShippingMethodTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('product_shipping_method', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('product_id')->unsigned();
      $table->foreign('product_id')->references('id')->on('products');
      $table->integer('shipping_method_id')->unsigned();
      $table->foreign('shipping_method_id')->references('id')->on('shipping_methods')->onDelete('cascade');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('product_shipping_method');
  }
}
