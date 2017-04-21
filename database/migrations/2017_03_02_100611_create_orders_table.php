<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('order_status_id')->unsigned();
            $table->string('shipping_method_name');
            $table->string('shipping_cost');
            $table->string('total_cost');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('address');
            $table->text('comments')->nullable();
            $table->string('invoice_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
