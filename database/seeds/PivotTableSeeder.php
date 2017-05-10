<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PivotTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    // Fill pivot tables, I'm doing it this way
    // to prevent creating models for pivot tables
    for($i = 1; $i <= App\Product::all()->count(); $i++)
    {
      $category_id = App\Category::inRandomOrder()->first()->id;
      $product_id = $i;

      DB::table('category_product')->insert([
        'category_id' => $category_id,
        'product_id' => $product_id,
      ]);
    }


    for($i = 1; $i <= App\Order::all()->count(); $i++)
    {
      $order_id = $i;
      $product_id = App\Product::inRandomOrder()->first()->id;
      $product_title = App\Product::find($product_id)->title;
      $product_price = App\Product::find($product_id)->price;
      $product_quantity = rand(1, 9);

      DB::table('order_product')->insert([
        'order_id' => $order_id,
        'product_id' => $product_id,
        'product_title' => $product_title,
        'product_price' => $product_price,
        'product_quantity' => $product_quantity,
      ]);
    }

    for($i = 1; $i <= App\Product::all()->count(); $i++)
    {
      for($j = 1; $j <= App\ShippingMethod::all()->count(); $j++)
      {
        $product_id = $i;
        $shipping_method_id = $j;

        DB::table('product_shipping_method')->insert([
          'product_id' => $i,
          'shipping_method_id' => $j,
        ]);
      }
    }
  }
}
